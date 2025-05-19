<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert([
            'phone_number' => '081234567890',
            'email' => 'digitaldream@gmail.com',
            'social_media' => '@digitalndream',
            'video' => 'https://www.youtube.com/watch?v=VEqdzHgNepw',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
