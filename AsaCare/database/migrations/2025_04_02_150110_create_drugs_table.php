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
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->double('price');
            $table->double('quantity');
            $table->integer('dosis');
            $table->string('image', 255);
            $table->enum('type', ['tablet', 'sirup']);
            $table->enum('periode', ['Setiap Hari', 'Hari Tertentu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};
