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
        Schema::create('doctori', function (Blueprint $table) {
            $table->string('cnp_doctor', 13)->primary();
            $table->string('nume');
            $table->string('prenume');
            $table->string('email')->unique();
            $table->string('parola'); 
            $table->unsignedBigInteger('specialitate_id');

            $table->foreign('specialitate_id')->references('id')->on('specialitati')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctori');
    }
};
