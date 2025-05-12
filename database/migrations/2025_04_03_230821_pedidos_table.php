<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('noivo_id')->constrained('noivos')->onDelete('cascade');
            $table->foreignId('padrinho_id')->nullable()->constrained('noivos')->onDelete('set null');
            
            $table->text('descricao_itens')->nullable(); // Armazena os itens em formato de texto
            $table->text('valor_itens')->nullable(); // <- ADICIONE ESSA LINHA
            $table->decimal('valor_total_itens', 10, 2)->default(0); // Total dos itens
            $table->decimal('valor_total_pago', 10, 2)->default(0); // Quanto foi pago
            $table->decimal('valor_restante', 10, 2)->default(0); // Valor restante a pagar
            
            $table->string('status')->default('Ativo');
            $table->string('status_pagamento')->nullable()->default(null)->change();
            $table->text('metodo_pagamento')->nullable(); // Tipo de pagamento
            $table->text('data_pagamento')->nullable(); // Data do pagamento
            $table->text('valor_pagamentos')->nullable();
            
            $table->date('datadalocacao')->nullable();
            $table->date('datadasegundaprova')->nullable();
            $table->date('datadaretirada')->nullable();
            $table->date('datadoevento')->nullable();
            
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};
