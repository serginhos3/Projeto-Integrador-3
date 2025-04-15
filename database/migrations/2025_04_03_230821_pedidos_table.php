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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('noivo_id');            
            $table->string('noivo');
            $table->decimal('valor')->unique();
            $table->string('procedimento')->nullable();
            $table->text('dentista')->nullable();
            $table->enum('status', ['Em aberto', 'Pendente', 'Em andamento', 'Concluído', 'Cancelado'])->default('Em aberto');
            $table->date('data')->nullable(); 
            $table->timestamps();                        
            $table->foreign('noivo_id')->references('id')->on('noivos')->onDelete('cascade');
              
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
