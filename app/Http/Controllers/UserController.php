<?php

namespace App\Http\Controllers;

use App\Models\RegisterRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $content = RegisterRequest::latest()->where('isVerified', null)
            ->where('pending_verification', false)->get();
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
