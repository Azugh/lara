<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequestRequest;
use App\Models\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    //
    public function index() {
        $content = RegisterRequest::where('isVerified', null)->orderBy('id', 'asc')->get();
        return view('admin.user.users', ['users' => $content]);
    }

    public function create() {
        return view('auth.signup');
    }

    public function store(Request $request) {
//        dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tel' => ['required', 'string', 'size:11'],
        ]);

        $reg = new RegisterRequest();
        $reg->name = $request['name'];
        $reg->message = $request['message'];
        $reg->tel = $request['tel'];
        $reg->password = $request['password'];
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
        if ($req['isVerified'] == null) {
            $req['isVerified'] = true;
            $req->update();

            $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => $req->password,
                'tel' => $req->tel,
                'department' => $req->department,
            ]);

            event(new Registered($user));

            return redirect()->route('register_request.index')->with('success', 'Email подтвержден.');
        }
        return redirect()->route('register_request.index')->with('error', 'ошибка');
    }

    public function update(RegisterRequestRequest $request, $id) {
        dd($id);
        $request = $request->all();
        $rr = RegisterRequest::findOrFail($id);
        dd($rr);
        $request['isVerified'] = true;
        $request['verified_at'] = Carbon::now();
        $rr->update($request);
        return redirect()->route('admin')->with('success', 'Запрос одобрен!');
    }
}
