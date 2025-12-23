<?php

namespace App\Http\Controllers;

use App\Models\User;
use function PHPUnit\Framework\isNan;

class UserController extends Controller
{
    public function index()
    {
        $content = User::latest()->where('email_verified_at', null)->get();
        return view('admin.user.users', ['users' => $content]);
    }


    // подтвердить email
    public function verifyEmail($id)
    {
        $user = User::findOrFail($id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            return redirect()->route('user.index')->with('success', 'Email подтвержден.');
        }
        return redirect()->route('user.index')->with('error', 'ошибка');
    }

    public function update($id) {
        $user = User::findOrFail($id);

        $user->email_verified_at = now();
    }
}
