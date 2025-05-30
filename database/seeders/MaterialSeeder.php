<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        $courses = DB::table('courses')->pluck('id');

        foreach ($courses as $courseId) {
            for ($i = 1; $i <= 5; $i++) {
                Material::create([
                    'course_id' => $courseId,
                    'title' => "Material $i for Course $courseId",
                    'video' => "https://www.youtube.com/watch?v=T1TR-RGf2Pw",
                    'content' => "This is the content of Material $i for Course $courseId",
                    'status' => 1,
                ]);
            }
        }
    }
}
