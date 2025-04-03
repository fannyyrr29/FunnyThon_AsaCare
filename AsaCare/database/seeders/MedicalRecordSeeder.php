<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medical_record')->insert([
            [
                'diagnose' => 'Diabetes Tipe 2',
                'description' => 'Pasien mengalami gejala diabetes.',
                'date' => '2023-01-10 09:00:00',
                'rating' => 5,
                'total' => 400000,
                'user_id' => 2, 
                'doctor_id' => 1 
            ],
            [
                'diagnose' => 'Hipertensi',
                'description' => 'Pasien mengalami tekanan darah tinggi.',
                'date' => '2023-01-15 10:00:00',
                'rating' => 4,
                'total' => 100000,
                'user_id' => 3, 
                'doctor_id' => 2 
            ],
            [
                'diagnose' => 'Luka Pasca Operasi',
                'description' => 'Perawatan luka setelah operasi.',
                'date' => '2023-01-20 11:00:00',
                'rating' => 5,
                'total' => 400000,
                'user_id' => 4, 
                'doctor_id' => 3 
            ]
        ]);
    }
}
