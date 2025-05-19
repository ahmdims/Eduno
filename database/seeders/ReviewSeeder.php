<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Course;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $users = User::take(5)->get();
        $course1 = Course::first();

        foreach ($users as $user) {
            Review::create([
                'user_id' => $user->id,
                'course_id' => $course1->id,
                'review' => 'This course is amazing! I learned so much and feel confident in my skills.',
            ]);
        }
    }
}
