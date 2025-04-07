<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrugRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drug_records')->insert([
            [
                'medical_record_id' => 1, 
                'drug_id' => 1, 
                'amount' => 1,
                'subtotal' => 5000,
                'status' => 1 
            ],
            [
                'medical_record_id' => 1,
                'drug_id' => 2, 
                'amount' => 2,
                'subtotal' => 30000,
                'status' => 1
            ],
            [
                'medical_record_id' => 1,
                'drug_id' => 3, 
                'amount' => 1,
                'subtotal' => 8000,
                'status' => 1
            ],
            [
                'medical_record_id' => 2,
                'drug_id' => 4,
                'amount' => 1,
                'subtotal' => 12000,
                'status' => 1
            ],
            [
                'medical_record_id' => 2,
                'drug_id' => 5, 
                'amount' => 1,
                'subtotal' => 20000,
                'status' => 1
            ],
            [
                'medical_record_id' => 2,
                'drug_id' => 6, 
                'amount' => 1,
                'subtotal' => 5000,
                'status' => 1
            ],
            [
                'medical_record_id' => 3,
                'drug_id' => 7, 
                'amount' => 3,
                'subtotal' => 146700,
                'status' => 0
            ],
            [
                'medical_record_id' => 3,
                'drug_id' => 8, 
                'amount' => 1,
                'subtotal' => 53000,
                'status' => 0
            ],
            [
                'medical_record_id' => 3,
                'drug_id' => 9, 
                'amount' => 1,
                'subtotal' => 39400,
                'status' => 0
            ],
            [
                'medical_record_id' => 3,
                'drug_id' => 10, 
                'amount' => 1,
                'subtotal' => 24000,
                'status' => 0
            ]
        ]);
    }
}
