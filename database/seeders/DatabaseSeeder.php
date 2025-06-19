<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            // UserSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            // MaterialSeeder::class,
            // QuizSeeder::class,
            // ReviewSeeder::class,
            // PlanSeeder::class,
            ArticleSeeder::class,
            FaqSeeder::class,
            WebsiteSeeder::class,
            // MailSeeder::class,
        ]);
    }
}
