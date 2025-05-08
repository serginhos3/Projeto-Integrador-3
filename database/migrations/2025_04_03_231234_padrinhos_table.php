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

            // Informações pessoais
            $table->string('nome');
            $table->string('telefone')->nullable();
            $table->string('email')->unique();
            $table->string('status')->nullable();
            $table->text('observacoes')->nullable();

            // Informações do evento
            $table->date('datadoevento')->nullable();
            $table->date('datadalocacao')->nullable();
            $table->date('datadaretirada')->nullable();
            $table->text('observacoesevento')->nullable();

            // Medidas do terno
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

            // Chave estrangeira
            $table->foreign('noivo_id')->references('id')->on('noivos')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::table('padrinhos', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'observacoes',
                'noivo_id',
                'datadalocacao',
                'datadaretirada',
                'observacoesevento',
                'paleto',
                'calca',
                'camisa',
                'colete',
                'manga',
                'barra_calca',
                'modelo_terno',
                'cor_terno',
                'observacoes_medidas'
            ]);

            $table->dropForeign(['noivo_id']);
        });
    }
};
