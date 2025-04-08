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
                'user_id' => 5, 
                'medical_record_id' => 1, 
                'drug_id' => 1, 
                'status' => 1,
                'start_date' => '2023-01-10',
                'duration_day' => 3
            ],
            [
                'user_id' => 3, 
                'medical_record_id' => 2, 
                'drug_id' => 4, 
                'status' => 0,
                'start_date' => '2023-01-10',
                'duration_day' => 3
            ],
        ]);
    }
}
