<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conditions')->insert([
            [
                'condition' => 'Kurang Sehat', 
                'date' => now(),
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'condition' => 'Sehat', 
                'date' => now(),
                'user_id' => 2,
                'created_at' => now()
            ],
            [
                'condition' => 'Sakit', 
                'date' => now(),
                'user_id' => 3,
                'created_at' => now()
            ]
            ]);
    }
}
