<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reminder_times', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade');
            $table->foreignId('drug_id')->constrained('drugs')->onDelete('cascade');
            $table->foreignId('time_id')->constrained('times')->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->primary(['user_id', 'medical_record_id', 'drug_id', 'time_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminder_times');
    }
};
