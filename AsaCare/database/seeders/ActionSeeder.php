<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actions')->insert([
            [
                'name'=>'Konsultasi Medis Online',
                'description'=>'Konsultasi medis online',
                'image'=>'konsultasi.jpg',
                'type'=>'Homecare',
                'price'=>0
            ],
            [
                'name'=>'Pemeriksaan Kesehatan Rutin',
                'description'=>'Cek tekanan darah, gula darah, kolesterol',
                'image'=>'pemeriksaan.jpg',
                'type'=>'Homecare',
                'price'=>100000
            ],
            [
                'name'=>'Perawatan Luka',
                'description'=>'Perawatan luka diabetes, luka pasca operasi',
                'image'=>'luka.jpg',
                'type'=>'Homecare',
                'price'=>400000
            ],
            [
                'name'=>'Fisioterapi di Rumah',
                'description'=>'Pemulihan pasca stroke, terapi sendi',
                'image'=>'fisioterapi.jpg',
                'type'=>'Homecare',
                'price'=>300000
            ],
            [
                'name'=>'Pendampingan Lansia',
                'description'=>'Perawatan harian, bantuan aktivitas',
                'image'=>'pendampingan.jpg',
                'type'=>'Homecare',
                'price'=>300000
            ],
            [
                'name'=>'Pemberian Obat dan Infus di Rumah',
                'description'=>'Pemberian obat dan infus',
                'image'=>'infus.jpg',
                'type'=>'Homecare',
                'price'=>400000
            ],
            [
                'name'=>'Booking Janji Temu dengan Dokter Umum',
                'description'=>'Booking janji temu dengan dokter umum',
                'image'=>'booking.jpg',
                'type'=>'Hospitalcare',
                'price'=>0
            ],
            [
                'name'=>'Booking Janji Temu dengan Dokter Spesialis',
                'description'=>'Booking janji temu dengan dokter spesialis',
                'image'=>'booking.jpg',
                'type'=>'Hospitalcare',
                'price'=>0
            ],
        ]);
    }
}
