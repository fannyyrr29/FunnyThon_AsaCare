<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->insert([
            ['name' => 'Dokter Umum'],
            ['name' => 'Dokter Spesialis Anak'],
            ['name' => 'Dokter Spesialis Bedah'],
            ['name' => 'Dokter Spesialis Penyakit Dalam'],
            ['name' => 'Dokter Spesialis Jantung'],
            ['name' => 'Dokter Spesialis Kulit dan Kelamin'],
            ['name' => 'Dokter Spesialis THT (Telinga, Hidung, Tenggorokan)'],
            ['name' => 'Dokter Spesialis Mata'],
            ['name' => 'Dokter Spesialis Gigi dan Mulut'],
            ['name' => 'Dokter Spesialis Kebidanan dan Kandungan'],
            ['name' => 'Dokter Spesialis Psikiatri'],
            ['name' => 'Dokter Spesialis Rehabilitasi Medik'],
            ['name' => 'Dokter Spesialis Anestesi'],
            ['name' => 'Dokter Spesialis Radiologi'],
            ['name' => 'Dokter Spesialis Patologi Klinik'],
            ['name' => 'Dokter Spesialis Orthopedi'],
            ['name' => 'Dokter Spesialis Urologi'],
            ['name' => 'Dokter Spesialis Gastroenterologi'],
            ['name' => 'Dokter Spesialis Endokrinologi'],
            ['name' => 'Dokter Spesialis Hematologi'],
            ['name' => 'Dokter Spesialis Onkologi'],
            ['name' => 'Dokter Spesialis Pulmonologi'],
            ['name' => 'Dokter Spesialis Neurologi'],
            ['name' => 'Dokter Spesialis Geriatri'],
            ['name' => 'Dokter Spesialis Kardiologi'],
            ['name' => 'Dokter Spesialis Infeksi'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat'],
            ['name' => 'Dokter Spesialis Bedah Saraf'],
            ['name' => 'Dokter Spesialis Bedah Plastik'],
            ['name' => 'Dokter Spesialis Fertilitas'],
            ['name' => 'Dokter Spesialis Penyakit Tropis'],
            ['name' => 'Dokter Spesialis Penyakit Dalam Anak'],
            ['name' => 'Dokter Spesialis Kesehatan Mental'],
            ['name' => 'Dokter Spesialis Olahraga'],
            ['name' => 'Dokter Spesialis Perawatan Paliatif'],
            ['name' => 'Dokter Spesialis Kesehatan Reproduksi'],
            ['name' => 'Dokter Spesialis Kesehatan Anak'],
            ['name' => 'Dokter Spesialis Kesehatan Lingkungan'],
            ['name' => 'Dokter Spesialis Kesehatan Kerja'],
            ['name' => 'Dokter Spesialis Kesehatan Gigi'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Anak'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Dewasa'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Lansia'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Wanita'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Pria'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Remaja'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Anak-Anak'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Keluarga'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Global'],
            ['name' => 'Dokter Spesialis Kesehatan Masyarakat Internasional']
        ]);
    }
}
