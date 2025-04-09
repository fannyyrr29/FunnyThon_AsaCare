<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            [
                'name' => 'Dr. Ahmad Fauzi',
                'license_number' => 'L123456',
                'experience_year' => 10,
                'rating' => 4.5,
                'user_id' => 13,
                'hospital_id' => 1
            ],
            [
                'name' => 'Dr. Budi Santoso',
                'license_number' => 'L234567',
                'experience_year' => 8,
                'rating' => 4.7,
                'user_id' => 14,
                'hospital_id' => 2
            ],
            [
                'name' => 'Dr. Cinta Dewi',
                'license_number' => 'L345678',
                'experience_year' => 12,
                'rating' => 4.8,
                'user_id' => 15,
                'hospital_id' => 1
            ],
            [
                'name' => 'Dr. Dedi Prasetyo',
                'license_number' => 'L456789',
                'experience_year' => 5,
                'rating' => 4.3,
                'user_id' => 16,
                'hospital_id' => 3
            ],
            [
                'name' => 'Dr. Eka Putri',
                'license_number' => 'L567890',
                'experience_year' => 7,
                'rating' => 4.6,
                'user_id' => 17,
                'hospital_id' => 2
            ],
            [
                'name' => 'Dr. Fajar Setiawan',
                'license_number' => 'L678901',
                'experience_year' => 9,
                'rating' => 4.4,
                'user_id' => 18,
                'hospital_id' => 1
            ],
            [
                'name' => 'Dr. Gita Sari',
                'license_number' => 'L789012',
                'experience_year' => 6,
                'rating' => 4.2,
                'user_id' => 19,
                'hospital_id' => 3
            ],
            [
                'name' => 'Dr. Hadi Pratama',
                'license_number' => 'L890123',
                'experience_year' => 11,
                'rating' => 4.9,
                'user_id' => 20,
                'hospital_id' => 1
            ],
            [
                'name' => 'Dr. Ika Lestari',
                'license_number' => 'L901234',
                'experience_year' => 4,
                'rating' => 4.1,
                'user_id' => 21,
                'hospital_id' => 2
            ],
            [
                'name' => 'Dr. Kiki Suryadi',
                'license_number' => 'L123456',
                'experience_year' => 3,
                'rating' => 4.0,
                'user_id' => 22, 
                'hospital_id' => 1
            ],
            [
                'name' => 'Dr. Lina Wati',
                'license_number' => 'L234567',
                'experience_year' => 10,
                'rating' => 4.5,
                'user_id' => 23,
                'hospital_id' => 2
            ],
            [
                'name' => 'Dr. Mira Sari',
                'license_number' => 'L345678',
                'experience_year' => 7,
                'rating' => 4.6,
                'user_id' => 24,
                'hospital_id' => 1
            ],
            [
                'name' => 'Dr. Oki Prasetyo',
                'license_number' => 'L567890',
                'experience_year' => 6,
                'rating' => 4.3,
                'user_id' => 25,
                'hospital_id' => 2
            ],
            [
                'name' => 'Dr. Nani Lestari',
                'license_number' => 'L456789',
                'experience_year' => 8,
                'rating' => 4.4,
                'user_id' => 26,
                'hospital_id' => 3
            ]
        ]);
    }
}
