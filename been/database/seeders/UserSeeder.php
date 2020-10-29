<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'name' => 'a',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => 'useruser', // password
            'remember_token' => Str::random(10),
            ]);
    }
}
