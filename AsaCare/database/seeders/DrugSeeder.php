<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::class('drugs')->insert([
            [
                'name'=>'Paracetamol (500 mg)',
                'price'=>5000,
                'dosis'=>1,
                'periode'=>'Hari Tertentu',
            ],
            [
                'name'=>'Amoxicillin (500 mg)',
                'price'=>15000,
                'dosis'=>2,
                'periode'=>'Setiap Hari',
            ],
            [
                'name'=>'Cetirizine (10 mg)',
                'price'=>8000,
                'dosis'=>1,
                'periode'=>'Hari Tertentu',
            ],
            [
                'name'=>'Ranitidine (150 mg)',
                'price'=>12000,
                'dosis'=>1,
                'periode'=>'Hari Tertentu',
            ],
            [
                'name'=>'Metformin (500 mg)',
                'price'=>20000,
                'dosis'=>1,
                'periode'=>'Setiap Hari',
            ],
            [
                'name'=>'Aspirin (80 mg)',
                'price'=>5000,
                'dosis'=>1,
                'periode'=>'Hari Tertentu',
            ],
            [
                'name'=>'Mylanta Sirup (150 ml)',
                'price'=>48900,
                'dosis'=>3,
                'periode'=>'Hari Tertentu',
            ],
            [
                'name'=>'Neurobion Forte',
                'price'=>53000,
                'dosis'=>1,
                'periode'=>'Setiap Hari',
            ],
            [
                'name'=>'Surbex-Z 6 Tablet',
                'price'=>39400,
                'dosis'=>1,
                'periode'=>'Setiap Hari',
            ],
            [
                'name'=>'Sangobion 10 Kapsul',
                'price'=>24000,
                'dosis'=>1,
                'periode'=>'Setiap Hari',
            ],
        ]);
    }
}
