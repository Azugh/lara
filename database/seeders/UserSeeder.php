<?php

namespace Database\Seeders;

use App\Models\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
//        DB::table('users')->truncate();
//        DB::table('roles')->truncate();
//        DB::table('role_user')->truncate();

        $adminRole = new Role();
        $adminRole['name'] = 'admin';
        $adminRole->save();

        Role::factory()->create([
            'name' => 'manager',
        ]);

        $adminUser = User::factory()->createOneQuietly([
            'name' => 'Admin',
            'email' => 'admin@admin.ru',
            'password' => config('app.admin_password'),
            'tel' => '89116972434',
            'remember_token' => null,
            'department' => 'Админ',
            'email_verified_at' => now(),
        ]);

        $adminUser->roles()->attach($adminRole);

        User::factory()->create([
            'name' => 'Тест не админ',
            'email' => 'test@mail.ru',
            'password' => config('app.admin_password'),
            'tel' => '89116972434',
            'department' => 'Продажи',
            'remember_token' => null,
        ]);


        for ($i = 1; $i < 6; $i++) {
            User::factory()->create([
                'name' => 'Тест ' . $i,
                'email' => 'user-' . $i . '@user.ru',
                'tel' => '8' . Arr::random(['911', '917', '981', '989']) . rand(1000000, 9999999),
                'department' => Arr::random(['Продажи', 'Маркетинг', 'Поддержка пользователей']),
                'remember_token' => null,
            ]);
        }


    }
}
