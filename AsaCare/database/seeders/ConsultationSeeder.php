<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('consultations')->insert([
            [
                'user_id'=>5,
                'doctor_id'=>1,
                'medical_record_id'=>1
            ],
            [
                'user_id'=>3,
                'doctor_id'=>2,
                'medical_record_id'=>2
            ],
            [
                'user_id'=>4,
                'doctor_id'=>3,
                'medical_record_id'=>3
            ]
        ]);
    }
}
