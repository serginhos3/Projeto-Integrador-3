<?php

namespace Tests\Feature;

use App\Models\Pedido;
use App\Models\Noivo;
use App\Models\Padrinho;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_pedido(): void
    {
        $noivo = Noivo::factory()->create();
        $pedido = Pedido::factory()->create(['noivo_id' => $noivo->id]);
        $this->assertDatabaseHas('pedidos', ['id' => $pedido->id]);
    }

    public function test_relacionamento_padrinhos(): void
    {
        $pedido = Pedido::factory()->create();
        $padrinho = Padrinho::factory()->create();
        $pedido->padrinhos()->attach($padrinho->id);
        $this->assertTrue($pedido->padrinhos->contains($padrinho));
    }

    public function test_remover_padrinho_do_pedido(): void
    {
        $pedido = Pedido::factory()->create();
        $padrinho = Padrinho::factory()->create();
        $pedido->padrinhos()->attach($padrinho->id);
        $pedido->padrinhos()->detach($padrinho->id);
        $this->assertFalse($pedido->padrinhos->contains($padrinho));
    }

    public function test_valor_total_itens(): void
    {
        $pedido = Pedido::factory()->create(['valor_total_itens' => 100.50]);
        $this->assertEquals(100.50, $pedido->valor_total_itens);
    }

    public function test_status_do_pedido(): void
    {
        $pedido = Pedido::factory()->create(['status' => 'ativo']);
        $this->assertEquals('ativo', $pedido->status);
    }
}
