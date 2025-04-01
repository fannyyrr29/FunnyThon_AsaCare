<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::class('times')->insert([
            ['time' => '05:00:00'],
            ['time' => '06:00:00'],
            ['time' => '07:30:00'],
            ['time' => '08:00:00'],
            ['time' => '09:00:00'],
            ['time' => '10:00:00'],
            ['time' => '11:30:00'],
            ['time' => '12:00:00'],
            ['time' => '12:30:00'],
            ['time' => '13:00:00'],
            ['time' => '14:00:00'],
            ['time' => '15:30:00'],
            ['time' => '16:00:00'],
            ['time' => '17:00:00'],
            ['time' => '18:00:00'],
            ['time' => '19:30:00'],
            ['time' => '20:00:00'],
            ['time' => '21:00:00'],
            ['time' => '22:00:00'],
            ['time' => '22:30:00'],
            ['time' => '23:00:00']
        ]);
    }
}
