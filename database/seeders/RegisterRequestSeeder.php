<?php

namespace Database\Seeders;

use App\Models\RegisterRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegisterRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegisterRequest::factory()->count(7)->create();
    }
}
