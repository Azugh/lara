<?php

namespace App\Http\Controllers;

use App\Models\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $content = DB::table('users')->latest()->get();
        return view('admin.user.users', ['users' => $content]);
    }

    // подтвердить email
//    public function verifyEmail($id)
//    {
//        $user = User::findOrFail($id);
//        if (!$user->hasVerifiedEmail()) {
//            $user->markEmailAsVerified();
//            return redirect()->route('admin.user.index')->with('success', 'Email подтвержден.');
//        }
//        return redirect()->route('admin.user.index')->with('error', 'ошибка');
//    }

    public function update($id) {
        $user = User::findOrFail($id);

        $user->email_verified_at = now();
    }

    /*
     * Админ создает менеджеров
     */
    public function promoteToManager(string $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->attach(Role::where('name', 'manager')->first());

        return redirect()->route('admin.user.index');

    }
}
