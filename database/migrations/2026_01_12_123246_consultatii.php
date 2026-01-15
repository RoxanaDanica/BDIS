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
        Schema::create('consultatii', function (Blueprint $table) {
            $table->id(); 
            $table->string('cnp_pacient', 13);
            $table->string('cnp_doctor', 13);
            $table->date('data_consultatiei');
            $table->text('diagnostic');
            $table->text('medicamentatie');

          
            $table->foreign('cnp_pacient')->references('cnp')->on('pacienti')
                ->onDelete('cascade');
            $table->foreign('cnp_doctor')->references('cnp_doctor')->on('doctori')
                ->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultatii');
    }
};
