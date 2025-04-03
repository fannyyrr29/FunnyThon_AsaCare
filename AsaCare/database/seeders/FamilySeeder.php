<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('families')->insert([
            [
                'sender_id' => 3,
                'receiver_id' => 4,
                'status' => 1
            ],
            [
                'sender_id' => 3,
                'receiver_id' => 5,
                'status' => 1
            ],
            [
                'sender_id' => 4,
                'receiver_id' => 6,
                'status' => 1
            ],
            [
                'sender_id' => 5,
                'receiver_id' => 6,
                'status' => 0
            ],
            [
                'sender_id' => 3,
                'receiver_id' => 7,
                'status' => 1
            ],
            [
                'sender_id' => 4,
                'receiver_id' => 8,
                'status' => 1
            ],
            [
                'sender_id' => 5,
                'receiver_id' => 9,
                'status' => 1
            ],
            [
                'sender_id' => 6,
                'receiver_id' => 10,
                'status' => 0
            ],
            [
                'sender_id' => 7,
                'receiver_id' => 8,
                'status' => 1
            ],
            [
                'sender_id' => 8,
                'receiver_id' => 9,
                'status' => 1
            ],
            [
                'sender_id' => 9,
                'receiver_id' => 10,
                'status' => 1
            ],
            [
                'sender_id' => 3,
                'receiver_id' => 6,
                'status' => 1
            ],
            [
                'sender_id' => 4,
                'receiver_id' => 5,
                'status' => 0
            ],
            [
                'sender_id' => 5,
                'receiver_id' => 7,
                'status' => 1
            ],
            [
                'sender_id' => 6,
                'receiver_id' => 8,
                'status' => 1
            ],
            [
                'sender_id' => 7,
                'receiver_id' => 9,
                'status' => 1
            ]
        ]);
    }
}
