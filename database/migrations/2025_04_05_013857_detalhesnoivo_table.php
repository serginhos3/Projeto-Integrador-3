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
        Schema::create('detalhesnoivo', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('telefone');
            $table->string('cep', 8)->nullable();
            $table->string('logradouro', 255)->nullable(); 
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 255)->nullable(); 
            $table->string('bairro', 255)->nullable(); 
            $table->string('cidade', 255)->nullable(); 
            $table->string('estado', 2)->nullable();
            $table->date('datadoevento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalhesnoivo');
    }
};
