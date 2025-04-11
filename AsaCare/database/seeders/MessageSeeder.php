<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            [
                'consultation_id'=>1,
                'sender_id'=>5,
                'message'=>'Halo dokk'
            ],
            [
                'consultation_id'=>1,
                'sender_id'=>13,
                'message'=>'Ada yang bisa saya bantu?'
            ],
            [
                'consultation_id'=>1,
                'sender_id'=>5,
                'message'=>'Dok, bokong saya bisulan'
            ],
        ]);
    }
}
