<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReminderTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reminder_times')->insert([
            [
                'reminder_id' => 1, 
                'time_id'=> 3
            ],
            [
                'reminder_id' => 1, 
                'time_id'=> 7
            ],
            [
                'reminder_id' => 1, 
                'time_id'=> 11
            ],
        ]);
    }
}
