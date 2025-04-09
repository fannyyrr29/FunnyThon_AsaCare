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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('NIK', 16)->nullable();
            $table->string('name', 255);
            $table->string('phone_number', 12)->nullable();
            $table->string('address', 500)->nullable();
            $table->enum('role', ['Admin', 'User', 'Dokter']);
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->date('birthdate')->nullable();
            $table->string('profile', 45)->nullable();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('google_token', 255)->nullable();
            $table->string('google_id', 255)->nullable();
            $table->string('google_refresh_token', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
