<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [];
        $courses = DB::table('courses')->pluck('id');

        foreach ($courses as $courseId) {
            for ($i = 1; $i <= 5; $i++) {
                $materials[] = [
                    'course_id' => $courseId,
                    'title' => "Material $i for Course $courseId",
                    'video' => "https://www.youtube.com/watch?v=T1TR-RGf2Pw",
                    'content' => "This is the content of Material $i for Course $courseId",
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        DB::table('materials')->insert($materials);
    }
}