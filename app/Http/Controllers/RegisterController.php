<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequestRequest;
use App\Models\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    //
    public function index()
    {
        $content = RegisterRequest::where('isVerified', null)
            ->where('pending_verification', false)
            ->orderBy('id', 'asc')->get();
        return view('admin.user.users', ['users' => $content]);
    }

    public function store(RegisterRequestRequest $request)
    {
        RegisterRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'message' => $request->message,
            'department' => $request->department,
        ]);

        return redirect()->route('home.index')
            ->with('success', 'Ваш запрос отправлен на рассмотрение!');
    }

    public function create()
    {
        return view('auth.signup');
    }

    // подтверждение и создание записи в таблице users

    //TODO ОБЗЕРВЕР
    public function verifyUser($id)
    {
        $req = RegisterRequest::findOrFail($id);

        Log::error('error', [$req]);

        if (is_null($req['isVerified']) && !$req['pending_verification']) {

            $req['pending_verification'] = true;
            $req->update();
//            $userPassword = Str::random(8);
            $this->createUser($req);
            //{{
//            $this->sendEmailVerification($req, $userPassword);
            return redirect()->route('admin.register_request.index')->with('success', 'Email подтвержден.');
        }
        return redirect()->route('admin.register_request.index')->with('error', 'ошибка');
    }

//    public function sendEmailVerification($user, $userPassword)
//    {
//        try {
//            Mail::to($user->email)->send(new VerifyMail($user, $userPassword));
//            Log::info('success', [$user->email, $userPassword]);
//
//        } catch (Exception $e) {
//            Log::error('error', [$e]);
//            dd($e->getMessage());
//        }
//    }

    public function createUser(RegisterRequest $request)
    {
//        $userPassword = Str::random(8);
//        Log::error('Password', [$userPassword, $request->email]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'department' => $request->department,
            'email_verified_at' => now(),
        ]);


//        $this->sendEmailVerification($user, $userPassword);
//        $user->save();
    }

    /**
     * verify and create user by email
     */
    public function verifyMail(Request $request)
    {
        try {
//            $reg = RegisterRequest::findOrFail($request->id);
//            $this->createUser($reg, $request->password);
//            $reg['isVerified'] = true;
//            $reg->update();
            return redirect()->route('email-is-verified');
        } catch (Exception $e) {
            dd($e->getMessage());
        }

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
