<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('padrinhos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('noivo_id');

          
            $table->string('nome');
            $table->string('telefone')->nullable();
            $table->string('email')->unique();
            $table->string('status')->nullable();
            $table->text('observacoes')->nullable();

            
            $table->date('datadoevento')->nullable();
            $table->date('datadalocacao')->nullable();
            $table->date('datadaretirada')->nullable();
            $table->text('observacoesevento')->nullable();

            
            $table->string('paleto')->nullable();
            $table->string('calca')->nullable();
            $table->string('camisa')->nullable();
            $table->string('colete')->nullable();
            $table->string('manga')->nullable();
            $table->string('barra_calca')->nullable();
            $table->string('modelo_terno')->nullable();
            $table->string('cor_terno')->nullable();
            $table->text('observacoes_medidas')->nullable();

            $table->timestamps();

     
            $table->foreign('noivo_id')->references('id')->on('noivos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
   
        Schema::table('padrinhos', function (Blueprint $table) {
            $table->dropForeign(['noivo_id']);
        });

       
        Schema::dropIfExists('padrinhos');
    }
};
