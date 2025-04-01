<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::class('hospitals')->insert([
            [
                'name' => 'RSUD Dr. Soetomo',
                'address' => 'Jl. Mayjen Prof. Dr. Moestopo No. 6-8, Surabaya',
                'phone_number' => '031-550-1000'
            ],
            [
                'name' => 'RS Siloam Surabaya',
                'address' => 'Jl. Raya Ngagel No. 123, Surabaya',
                'phone_number' => '031-9900-8888'
            ],
            [
                'name' => 'RS Mitra Keluarga Surabaya',
                'address' => 'Jl. Raya Darmo No. 30, Surabaya',
                'phone_number' => '031-567-7777'
            ],
            [
                'name' => 'RS Al-Ihsan',
                'address' => 'Jl. Raya Kertajaya No. 1, Surabaya',
                'phone_number' => '031-501-1111'
            ],
            [
                'name' => 'RS Bhakti Rahayu',
                'address' => 'Jl. Raya Kalisari No. 10, Surabaya',
                'phone_number' => '031-828-8888'
            ],
            [
                'name' => 'RS Islam Surabaya',
                'address' => 'Jl. Raya Gubeng No. 10, Surabaya',
                'phone_number' => '031-501-2222'
            ],
            [
                'name' => 'RS Premier Bintaro',
                'address' => 'Jl. Raya Bintaro No. 1, Surabaya',
                'phone_number' => '031-9999-0000'
            ],
            [
                'name' => 'RS Haji Surabaya',
                'address' => 'Jl. Raya Haji No. 5, Surabaya',
                'phone_number' => '031-567-8888'
            ],
            [
                'name' => 'RS Pusat Pertamina',
                'address' => 'Jl. Raya Pertamina No. 2, Surabaya',
                'phone_number' => '031-567-9999'
            ],
            [
                'name' => 'RSUD Dr. Soewandi',
                'address' => 'Jl. Soewandi No. 1, Surabaya',
                'phone_number' => '031-531-1111'
            ]
        ]);
    }
}
