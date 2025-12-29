<?php

namespace App\Observers;

use App\Mail\VerifyMail;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user)
    {
//        dd(\Hash::make('Jiir0lYo'));
        try {
            $userPassword = Str::random(8);

            Log::info('password', [$userPassword]);
//            Log::debug('Creating User: ' . $user);
            $user->password = $userPassword;

            $this->sendEmailVerification($user, $userPassword);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function sendEmailVerification($user, $userPassword)
    {
        Log::info('password', [$userPassword]);

        try {
            Mail::to($user->email)->send(new VerifyMail($user, $userPassword));
            Log::info('success', [$user->email]);

        } catch (Exception $e) {
            Log::error('error', [$e]);
            dd($e->getMessage());
        }
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
        Log::info('пользователь', [$user->roles()->where('role_id', 1)->exists()]);
        Log::error('message', (array)'message');

//        dd($user);
//        $this->sendEmailVerification($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }

}

