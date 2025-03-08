<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('placa', 6);
            $table->dateTime('hora_ingreso');
            $table->dateTime('hora_salida')->nullable();
            $table->decimal('total_pago', 10, 2)->nullable();
            $table->enum('estado', ['ingresado', 'salido'])->default('ingresado');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
