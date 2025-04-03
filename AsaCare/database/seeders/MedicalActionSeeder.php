<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicalActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medical_actions')->insert([
            [
                'medical_record_id' => 1,
                'action_id' => 1
            ],
            [
                'medical_record_id' => 1,
                'action_id' => 3
            ],
            [
                'medical_record_id' => 2,
                'action_id' => 2
            ],
            [
                'medical_record_id' => 3,
                'action_id' => 3
            ],
            [
                'medical_record_id' => 3,
                'action_id' => 5
            ]
        ]);
    }
}
