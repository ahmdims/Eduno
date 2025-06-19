<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $adminIds = User::where('utype', 'admin')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        if (empty($adminIds)) {
            throw new \Exception('No admin users found. Please seed admin users first.');
        }

        if (empty($categoryIds)) {
            throw new \Exception('No categories found. Please seed categories first.');
        }

        for ($i = 1; $i <= 1; $i++) {
            $title = "Course Title $i";
            $slug = Str::slug($title);

            Course::create([
                'user_id' => $adminIds[array_rand($adminIds)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'title' => $title,
                'slug' => $slug,
                'status' => 1,
                'description' => "This is a detailed description for Course $i. Learn essential concepts and techniques.",
            ]);
        }
    }
}
