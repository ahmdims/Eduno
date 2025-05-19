<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'Basic Plan',
                'price' => 100000,
                'duration' => 30,
                'pricing_features' => json_encode([
                    'Unlimited Access Courses' => true,
                    'Certificate After Completion' => true,
                    'Unlimited Emails' => false,
                    '24/7 Dedicated Support' => false,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Standard Plan',
                'price' => 800000,
                'duration' => 180,
                'pricing_features' => json_encode([
                    'Unlimited Access Courses' => true,
                    'Certificate After Completion' => true,
                    'High Resolution Videos' => false,
                    'Unlimited Emails' => false,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Exclusive Plan',
                'price' => 1500000,
                'duration' => 365,
                'pricing_features' => json_encode([
                    'Unlimited Access Courses' => true,
                    'Certificate After Completion' => true,
                    'High Resolution Videos' => true,
                    '24/7 Dedicated Support' => true,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}