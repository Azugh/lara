<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        "App\Model"=> \App\Policies\UserPolicy::class,
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        Passport::enablePasswordGrant();

        Passport::tokensExpireIn(Carbon::now()->addMinutes(30)); // Short-lived access tokens
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30)); // Long-lived refresh tokens (the "remember me" effect)
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(6));
    }
}
