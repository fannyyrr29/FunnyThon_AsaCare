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
        DB::table('doctor_has_actions')->insert([
            ['doctor_id' => 1,  'action_id' => 1],
            ['doctor_id' => 1, 'action_id' => 7],
            ['doctor_id' => 1, 'action_id' => 1],
            ['doctor_id' => 1, 'action_id' => 7],
            ['doctor_id' => 2, 'action_id' => 5],
            ['doctor_id' => 3, 'action_id' => 4],
            ['doctor_id' => 4, 'action_id' => 1],
            ['doctor_id' => 4, 'action_id' => 7],
            ['doctor_id' => 5, 'action_id' => 1],
            ['doctor_id' => 5, 'action_id' => 7],
            ['doctor_id' => 5, 'action_id' => 5],
            ['doctor_id' => 7, 'action_id' => 4],
            ['doctor_id' => 8, 'action_id'=> 1],
            ['doctor_id' => 8, 'action_id'=> 7],
            ['doctor_id' => 8, 'action_id' => 5],
            ['doctor_id' => 9, 'action_id' => 1],
            ['doctor_id' => 9, 'action_id' => 7],
            ['doctor_id' => 10,'action_id' => 4],
            ['doctor_id' => 11,'action_id' => 1],
            ['doctor_id' => 11,'action_id' => 7],
            ['doctor_id' => 12,'action_id' => 1],
            ['doctor_id' => 12,'action_id' => 7],
            ['doctor_id' => 13, 'action_id' => 5],
            ['doctor_id' => 14,'action_id' => 4]
        ]);
    }
}
