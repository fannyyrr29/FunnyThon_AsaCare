<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reminders')->insert([
            [
                'user_id' => 2, 
                'medical_record_id' => 1, 
                'drug_id' => 1, 
                'time_id' => 1, 
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ],
            [
                'user_id' => 2,
                'medical_record_id' => 1,
                'drug_id' => 2, 
                'time_id' => 2,
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ],
            [
                'user_id' => 2,
                'medical_record_id' => 1,
                'drug_id' => 3, 
                'time_id' => 3,
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ],
            [
                'user_id' => 2,
                'medical_record_id' => 1,
                'drug_id' => 4,
                'time_id' => 4,
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ],
            [
                'user_id' => 2,
                'medical_record_id' => 1,
                'drug_id' => 5, 
                'time_id' => 5,
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ],
            [
                'user_id' => 2,
                'medical_record_id' => 1,
                'drug_id' => 6,
                'time_id' => 6,
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ],
            [
                'user_id' => 2,
                'medical_record_id' => 1,
                'drug_id' => 7,
                'time_id' => 7,
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ],
            [
                'user_id' => 2,
                'medical_record_id' => 1,
                'drug_id' => 8,
                'time_id' => 8,
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ],
            [
                'user_id' => 2,
                'medical_record_id' => 1,
                'drug_id' => 9, 
                'time_id' => 9,
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ],
            [
                'user_id' => 2,
                'medical_record_id' => 1,
                'drug_id' => 10, 
                'time_id' => 10,
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 7
            ]
        ]);
    }
}
