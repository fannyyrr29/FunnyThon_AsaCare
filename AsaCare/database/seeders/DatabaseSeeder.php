<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EmergencyCall;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            ActionSeeder::class,
            DrugSeeder::class,
            HospitalSeeder::class,
            SpecializationSeeder::class,
            TimeSeeder::class,
            DoctorSeeder::class,
            DoctorHasSpecializationSeeder::class,
            EmergencyCallSeeder::class,
            MedicalRecordSeeder::class,
            MedicalActionSeeder::class,
            DrugRecordSeeder::class,
            FamilySeeder::class,
            ReminderSeeder::class,
            ConditionSeeder::class,
            ReminderTimeSeeder::class
        ]);
    }
}
