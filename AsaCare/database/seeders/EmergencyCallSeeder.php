<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmergencyCallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('emergencycall')->insert([
            [
                'name' => 'Andi Setiawan',
                'phone_number' => '081234567890',
                'user_id' => 2,
            ],
            [
                'name' => 'Budi Santoso',
                'phone_number' => '081234567891',
                'user_id' => 2,
            ],
            [
                'name' => 'Budi Santoso',
                'phone_number' => '081234567891',
                'user_id' => 3,
            ],
            [
                'name' => 'Citra Dewi',
                'phone_number' => '081234567892',
                'user_id' => 4,
            ],
            [
                'name' => 'Dedi Prasetyo',
                'phone_number' => '081234567893',
                'user_id' => 5,
            ],
            [
                'name' => 'Eka Putri',
                'phone_number' => '081234567894',
                'user_id' => 6,
            ]
        ]);
    }
}
