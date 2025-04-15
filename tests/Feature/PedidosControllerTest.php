<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidosControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_listar_pedidos()
    {
        $response = $this->get(route('pedidos.list'));

        $response->assertStatus(200)
            ->assertViewIs('pedidos.list');
    }

    public function test_tela_de_criacao_de_pedido_esta_acessivel()
    {
        $response = $this->get(route('pedidos.criar'));

        $response->assertStatus(200)
            ->assertViewIs('pedidos.criar');
    }

    public function test_criar_pedido()
    {
        $noivo = \App\Models\Noivo::create([
            'nome' => 'Noivo Teste',
            'email' => 'noivo@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datadoevento' => '2000-01-01',
        ]);

        $this->post(route('pedidos.store'), [
            'valor' => 'R$ 500,00',
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idnoivo' => $noivo->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $pedido = \App\Models\Pedido::first();

        $this->assertDatabaseHas('pedidos', [
            'id' => $pedido->id,
            'valor' => 500.00,
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
            'idnoivo' => $noivo->id,
        ]);
    }


    public function test_atualizar_status_pedido()
    {

        \App\Models\Noivo::create([
            'nome' => 'Noivo Teste',
            'email' => 'noivo@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datadoevento' => '2000-01-01',
        ]);

        $noivo = \App\Models\Noivo::first();

        $this->post(route('pedidos.store'), [
            'valor' => 'R$ 500,00',
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idnoivo' => $noivo->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $pedido = \App\Models\Pedido::first();

        $response = $this->post(route('pedidos.updateStatus', $pedido->id), [
            'status' => 'Em Andamento',
        ]);

        $response->assertJson(['success' => true, 'message' => 'Status atualizado com sucesso!']);

        $this->assertDatabaseHas('pedidos', ['id' => $pedido->id, 'status' => 'Em Andamento']);
    }


    public function test_tela_de_edicao_de_pedido_esta_acessivel()
    {

        \App\Models\Noivo::create([
            'nome' => 'Noivo Teste',
            'email' => 'noivo@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datadoevento' => '2000-01-01',
        ]);

        $noivo = \App\Models\Noivo::first();

        $this->post(route('pedidos.store'), [
            'valor' => 'R$ 500,00',
            'noivo' => "elza",
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idnoivo' => $noivo->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $pedido = \App\Models\Pedido::first();

        $response = $this->get(route('pedidos.editar', $pedido->id));
        $response->assertStatus(200);
    }

    public function test_atualizar_pedido()
    {

        \App\Models\Noivo::create([
            'nome' => 'Noivo Teste',
            'email' => 'noivo@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datadoevento' => '2000-01-01',
        ]);

        $noivo = \App\Models\Noivo::first();

        $this->post(route('pedidos.store'), [
            'valor' => 'R$ 500,00',
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'idnoivo' => $noivo->id,
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $pedido = \App\Models\Pedido::first();

        $response = $this->put(route('pedidos.atualizar', $pedido->id), [
            'valor' => 'R$ 800,00',
            'noivo' => 'elza',
            'procedimento' => 'Extração',
            'dentista' => 'Dr. Teste 2',
            'status' => 'Concluído',
            'data' => '2024-11-10',
        ]);

        $response->assertRedirect(route('pedidos.list'))
            ->assertSessionHas('status', 'Pedido atualizado com sucesso!');
    }

    public function test_excluir_pedido()
    {
        $noivo = \App\Models\Noivo::create([
            'nome' => 'Noivo Teste',
            'email' => 'noivo@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Teste',
            'cidade' => 'Cidade Teste',
            'estado' => 'SP',
            'datadoevento' => '2000-01-01',
        ]);

        $pedido = \App\Models\Pedido::create([
            'idnoivo' => $noivo->id,
            'noivo' => $noivo->nome,
            'valor' => 500.00,
            'procedimento' => 'Limpeza Dental',
            'dentista' => 'Dr. Teste',
            'status' => 'Em Aberto',
            'data' => '2024-11-01',
        ]);

        $response = $this->delete(route('pedidos.destroy', $pedido->id));

        $response->assertRedirect(route('pedidos.list'))
            ->assertSessionHas('status', 'Pedido excluído com sucesso!');

        $this->assertDatabaseMissing('pedidos', ['id' => $pedido->id]);
    }

}
