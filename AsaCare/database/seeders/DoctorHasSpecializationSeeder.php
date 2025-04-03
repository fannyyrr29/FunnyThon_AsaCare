<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorHasSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctor_has_specializations')->insert([
            ['doctor_id' => 1, 'specialization_id' => 1],
            ['doctor_id' => 1, 'specialization_id' => 2],
            ['doctor_id' => 2, 'specialization_id' => 3],
            ['doctor_id' => 3, 'specialization_id' => 4],
            ['doctor_id' => 3, 'specialization_id' => 5],
            ['doctor_id' => 4, 'specialization_id' => 1],
            ['doctor_id' => 5, 'specialization_id' => 2],
            ['doctor_id' => 5, 'specialization_id' => 3],
            ['doctor_id' => 6, 'specialization_id' => 4],
            ['doctor_id' => 7, 'specialization_id' => 5],
            ['doctor_id' => 8, 'specialization_id' => 1],
            ['doctor_id' => 8, 'specialization_id' => 3],
            ['doctor_id' => 9, 'specialization_id' => 2],
            ['doctor_id' => 10, 'specialization_id' => 4],
            ['doctor_id' => 10, 'specialization_id' => 5],
            ['doctor_id' => 11, 'specialization_id' => 1],
            ['doctor_id' => 12, 'specialization_id' => 2],
            ['doctor_id' => 13, 'specialization_id' => 3],
            ['doctor_id' => 14, 'specialization_id' => 4],
            ['doctor_id' => 15, 'specialization_id' => 5]
        ]);
    }
}
