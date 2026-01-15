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
        Schema::create('pacienti', function (Blueprint $table) {
            $table->string('cnp', 13)->primary();
            $table->string('nume');
            $table->string('prenume');
            $table->date('data_nasterii');
            $table->integer('varsta');
            $table->string('adresa');
            $table->string('email')->unique();
            $table->string('telefon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacienti');
    }
};
