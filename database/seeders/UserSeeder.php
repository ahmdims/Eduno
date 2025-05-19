<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'utype' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'id' => Str::uuid(),
                'name' => 'Student ' . $i,
                'username' => 'student' . $i,
                'email' => 'student' . $i . '@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'utype' => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}