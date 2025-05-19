<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'UI/UX Design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Frontend Development', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Backend Development', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Collaboration Tools', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Advanced Tools', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($categories);
    }
}