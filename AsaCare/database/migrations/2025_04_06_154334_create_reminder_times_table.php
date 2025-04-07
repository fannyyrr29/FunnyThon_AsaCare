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
            $table->foreignId('reminder_id')->constrained('reminders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('time_id')->constrained('times')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->primary(['reminder_id', 'time_id']);
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
