<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('noivos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('email', 255)->unique();
            $table->string('telefone', 15)->nullable();
            $table->string('padrinho', 255)->nullable();
            $table->string('endereco', 255)->nullable();
            $table->string('observacoesnoivo', 255)->nullable();
            $table->string('status')->nullable();

            $table->string('localevento', 255)->nullable();
            $table->date('datadoevento')->nullable();
            $table->date('datadalocacao')->nullable();
            $table->date('datadasegundaprova')->nullable();
            $table->date('datadaretirada')->nullable();
            $table->string('observacoesevento', 255)->nullable();

            // Novos campos de medidas do terno
            $table->string('paleto', 50)->nullable();
            $table->string('calca', 50)->nullable();
            $table->string('camisa', 50)->nullable();
            $table->string('colete', 50)->nullable();
            $table->string('manga', 50)->nullable();
            $table->string('barra_calca', 50)->nullable();
            $table->string('modelo', 100)->nullable();
            $table->string('cor', 100)->nullable();
            $table->string('observacoesmedidas', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('noivos');
        
    }
};
