<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [];
        $levels = ['Beginner', 'Intermediate', 'Advanced'];
        $languages = ['PHP', 'JavaScript', 'Python', 'Java', 'C++'];

        for ($i = 1; $i <= 21; $i++) {
            $title = "Course Title $i";
            $slug = Str::slug($title);

            $courses[] = [
                'title' => $title,
                'slug' => $slug,
                'status' => "published",
                'description' => "This is a detailed description for Course $i. In this course, you will learn the essential concepts and techniques to master the subject. Throughout the lessons, you will dive deep into key topics, gain hands-on experience, and apply what you've learned through practical exercises. Whether you're a beginner or have some prior knowledge, this course will provide valuable insights and skills to enhance your expertise. By the end of this course, you will be equipped with the knowledge necessary to excel in the field and tackle real-world challenges with confidence.",
                'category_id' => rand(1, 5),
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
