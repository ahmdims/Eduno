<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
use Faker\Factory as Faker;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Faq::create([
                'question' => $faker->sentence,
                'answer' => $faker->paragraphs(3, true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}