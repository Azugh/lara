<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequestRequest;
use App\Mail\VerifyEmail;
use App\Models\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Exception;

class RegisterController extends Controller
{
    //
    public function index()
    {
        $content = RegisterRequest::where('isVerified', null)->orderBy('id', 'asc')->get();
        return view('admin.user.users', ['users' => $content]);
    }

    public function create()
    {
        return view('auth.signup');
    }

    public function store(RegisterRequestRequest $request)
    {
//        dd($request);
//        $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
//            'password' => ['required', 'confirmed', Rules\Password::defaults()],
//            'tel' => ['required', 'string', 'size:11'],
//        ]);

        $reg = new RegisterRequest();
        $reg->name = $request['name'];
        $reg->message = $request['message'];
        $reg->tel = $request['tel'];
//        $reg->password = $request['password'];
        $reg->department = $request['department'];
        $reg->email = $request['email'];

        $reg->save();

        return redirect()->route('home.index')
            ->with('success', 'Ваш запрос отправлен на рассмотрение!');
    }

    // подтверждение и создание записи в таблице users
    public function verifyUser($id)
    {
        $req = RegisterRequest::findOrFail($id);
        Log::error('error', [$req]);
        if (is_null($req['isVerified'])) {
//            dd(is_null($req['isVerified']));
            $req['isVerified'] = true;
            $req->update();

//            $user = User::create([
//                'name' => $req->name,
//                'email' => $req->email,
//                'password' => Str::random(8),
//                'tel' => $req->tel,
//                'department' => $req->department,
//            ]);

            $user = $this->createUser($req);

//            event(new Registered($user));

            return redirect()->route('register_request.index')->with('success', 'Email подтвержден.');
        }
        return redirect()->route('register_request.index')->with('error', 'ошибка');
    }

    public function createUser(RegisterRequest $request)
    {
        $userPassword = Str::random(8);
        Log::error('Password', [$userPassword, $request->email]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $userPassword,
            'tel' => $request->tel,
            'department' => $request->department,
        ]);
        try {
            $this->sendEmailVerification($user, $userPassword);
            $user->save();
            return response(['message' => 'все прошло'], 200);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }

    }

    public function sendEmailVerification($user, $userPassword)
    {

        Mail::to($user->email)->send(new VerifyEmail($user, $userPassword));


    }

//    public function update(RegisterRequestRequest $request, $id) {
//        dd($id);
//        $request = $request->all();
//        $rr = RegisterRequest::findOrFail($id);
//        dd($rr);
//        $request['isVerified'] = true;
//        $request['verified_at'] = Carbon::now();
//        $rr->update($request);
//        return redirect()->route('admin')->with('success', 'Запрос одобрен!');
//    }
}
