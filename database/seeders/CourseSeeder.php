<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [];
        $levels = ['Beginner', 'Intermediate', 'Advanced'];
        $languages = ['PHP', 'JavaScript', 'Python', 'Java', 'C++'];

        $adminIds = User::where('utype', 'admin')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        if (empty($adminIds)) {
            throw new \Exception('No admin users found. Please seed admin users first.');
        }

        if (empty($categoryIds)) {
            throw new \Exception('No categories found. Please seed categories first.');
        }

        for ($i = 1; $i <= 21; $i++) {
            $title = "Course Title $i";
            $slug = Str::slug($title);

            $courses[] = [
                'user_id' => $adminIds[array_rand($adminIds)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'title' => $title,
                'slug' => $slug,
                'status' => 1,
                'description' => "This is a detailed description for Course $i. In this course, you will learn essential concepts and techniques...",
                'level' => $levels[array_rand($levels)],
                'language' => $languages[array_rand($languages)],
                'video' => "https://www.youtube.com/watch?v=T1TR-RGf2Pw",
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('courses')->insert($courses);
    }
}
