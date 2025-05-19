<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MailSeeder extends Seeder
{
    public function run()
    {
        DB::table('mails')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'subject' => 'Welcome to our platform',
                'message' => 'Thank you for signing up on our platform. We are excited to have you.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'subject' => 'Your account has been updated',
                'message' => 'Your account details have been successfully updated. Please check your profile for changes.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@example.com',
                'subject' => 'Password reset request',
                'message' => 'We received a request to reset your password. If you didn’t make this request, please ignore this message.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bob Brown',
                'email' => 'bob.brown@example.com',
                'subject' => 'Subscription Reminder',
                'message' => 'Your subscription is about to expire. Please renew your subscription to continue enjoying our services.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Charlie Davis',
                'email' => 'charlie.davis@example.com',
                'subject' => 'New feature update',
                'message' => 'We have added some exciting new features to our platform. Check them out now!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Diana Lee',
                'email' => 'diana.lee@example.com',
                'subject' => 'Your payment is due',
                'message' => 'Your payment for this month is due. Please make the payment to avoid service interruption.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Edward King',
                'email' => 'edward.king@example.com',
                'subject' => 'Account verification',
                'message' => 'Please verify your account by clicking the link sent to your email.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Fiona Green',
                'email' => 'fiona.green@example.com',
                'subject' => 'Survey Invitation',
                'message' => 'We would appreciate it if you could take a moment to complete our customer satisfaction survey.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'George Harris',
                'email' => 'george.harris@example.com',
                'subject' => 'Important security update',
                'message' => 'A recent security update was applied to your account. Please review the changes.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Hannah Martin',
                'email' => 'hannah.martin@example.com',
                'subject' => 'Product recommendation',
                'message' => 'Based on your recent activity, we have some product recommendations for you.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
