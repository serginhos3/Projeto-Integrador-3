<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Pedido;
use App\Models\Noivo;
use App\Models\User;

class PedidoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function deve_cadastrar_um_pedido_com_dados_validos()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();
        $dados = [
            'idnoivo' => $noivo->id,
            'descricao' => ['Terno', 'Gravata'],
            'valor' => [300, 200],
            'valor_total_itens' => 500,
            'valor_total_pago' => 250,
            'valor_restante' => 250,
            'status' => 'aberto',
            'datadalocacao' => '2025-12-10',
            'datadasegundaprova' => '2025-12-12',
            'datadaretirada' => '2025-12-14',
            'datadoevento' => '2025-12-15',
        ];
        $response = $this->post(route('pedidos.store'), $dados);
        $response->assertRedirect(route('pedidos.list'));
        $this->assertDatabaseHas('pedidos', ['descricao_itens' => 'Terno, Gravata']);
    }

    /** @test */
    public function nao_deve_cadastrar_pedido_sem_noivo()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $dados = [
            'descricao' => ['Terno'],
            'valor' => [100],
            'valor_total_itens' => 100,
            'valor_total_pago' => 0,
            'valor_restante' => 100,
            'status' => 'aberto',
            'datadalocacao' => '2025-12-10',
            'datadasegundaprova' => '2025-12-12',
            'datadaretirada' => '2025-12-14',
            'datadoevento' => '2025-12-15',
        ];
        $response = $this->post(route('pedidos.store'), $dados);
        $response->assertSessionHasErrors('idnoivo');
        $this->assertDatabaseMissing('pedidos', ['descricao_itens' => 'Terno']);
    }

    /** @test */
    public function deve_atualizar_um_pedido()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();
        $pedido = Pedido::create([
            'noivo_id' => $noivo->id,
            'descricao_itens' => 'Terno',
            'valor_itens' => '100',
            'valor_total_itens' => 100,
            'valor_total_pago' => 0,
            'valor_restante' => 100,
            'status' => 'aberto',
            'datadalocacao' => '2025-12-10',
            'datadasegundaprova' => '2025-12-12',
            'datadaretirada' => '2025-12-14',
            'datadoevento' => '2025-12-15',
        ]);
        $response = $this->put(route('pedidos.atualizar', $pedido->id), [
            'noivo_id' => $noivo->id,
            'descricao' => ['Terno atualizado'],
            'valor' => [200],
            'valor_total_itens' => 200,
            'valor_total_pago' => 0,
            'valor_restante' => 200,
            'status' => 'fechado',
            'datadalocacao' => '2025-12-10',
            'datadasegundaprova' => '2025-12-12',
            'datadaretirada' => '2025-12-14',
            'datadoevento' => '2025-12-15',
        ]);
        $response->assertRedirect(route('pedidos.list'));
        $this->assertDatabaseHas('pedidos', ['descricao_itens' => 'Terno atualizado']);
    }

    /** @test */
    public function deve_excluir_um_pedido()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();
        $pedido = Pedido::create([
            'noivo_id' => $noivo->id,
            'descricao' => 'Gravata',
            'valor' => 50,
            'status' => 'aberto',
        ]);
        $response = $this->delete(route('pedidos.destroy', $pedido->id));
        $response->assertRedirect(route('pedidos.list'));
        $this->assertDatabaseMissing('pedidos', ['id' => $pedido->id]);
    }

    /** @test */
    public function deve_mostrar_detalhes_do_pedido()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();
        $pedido = Pedido::create([
            'noivo_id' => $noivo->id,
            'descricao_itens' => 'Sapato',
            'valor_itens' => '80',
            'valor_total_itens' => 80,
            'valor_total_pago' => 0,
            'valor_restante' => 80,
            'status' => 'aberto',
            'datadalocacao' => '2025-12-10',
            'datadasegundaprova' => '2025-12-12',
            'datadaretirada' => '2025-12-14',
            'datadoevento' => '2025-12-15',
        ]);
        $response = $this->get(route('pedidos.show', $pedido->id));
        $response->assertStatus(200);
        $response->assertSee('Sapato');
    }
}
