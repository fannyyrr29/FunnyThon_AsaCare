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
        DB::table('drugs')->insert([
            [
                'name'=>'Paracetamol (500 mg)',
                'price'=>5000,
                'dosis'=>1,
                'quantity' => 12,
                'type'=>'tablet',
            ],
            [
                'name'=>'Amoxicillin (500 mg)',
                'price'=>15000,
                'dosis'=>2,
                'quantity' => 12,
                'type'=>'tablet',
            ],
            [
                'name'=>'Cetirizine (10 mg)',
                'price'=>8000,
                'dosis'=>1,
                'quantity' => 12,
                'type'=>'tablet',
            ],
            [
                'name'=>'Ranitidine (150 mg)',
                'price'=>12000,
                'dosis'=>1,
                'quantity' => 12,
                'type'=>'tablet',
            ],
            [
                'name'=>'Metformin (500 mg)',
                'price'=>20000,
                'dosis'=>1,
                'quantity' => 12,
                'type'=>'tablet',
            ],
            [
                'name'=>'Aspirin (80 mg)',
                'price'=>5000,
                'dosis'=>1,
                'quantity' => 10,
                'type'=>'tablet',
            ],
            [
                'name'=>'Mylanta Sirup (150 ml)',
                'price'=>48900,
                'dosis'=>3,
                'quantity' => 150,
                'type'=>'sirup',
            ],
            [
                'name'=>'Neurobion Forte',
                'price'=>53000,
                'dosis'=>1,
                'quantity' => 10,
                'type'=>'tablet',
            ],
            [
                'name'=>'Surbex-Z 6 Tablet',
                'price'=>39400,
                'dosis'=>1,
                'quantity' => 6,
                'type'=>'tablet',
            ],
            [
                'name'=>'Sangobion 10 Kapsul',
                'price'=>24000,
                'dosis'=>1,
                'quantity' => 10,
                'type'=>'tablet',
            ],
        ]);
    }
}
