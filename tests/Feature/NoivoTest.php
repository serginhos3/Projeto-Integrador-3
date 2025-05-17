<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Noivo;

class NoivoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    #[\PHPUnit\Framework\Attributes\Test]
    public function deve_cadastrar_um_noivo_com_dados_validos()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $dados = [
            'nome' => 'Carlos da Silva',
            'telefone' => '11999999999',
            'email' => 'carlos@email.com',
            'endereco' => 'Rua das Flores, 123',
            'status' => 'ativo',
            'observacoesnoivo' => 'Cliente exigente',
            'datadoevento' => '2025-12-15',
            'localevento' => 'Espaço Elite',
            'enderecoevento' => 'Av. Central, 1000',
            'datadalocacao' => '2025-12-10',
            'datadasegundaprova' => '2025-12-12',
            'datadaretirada' => '2025-12-14',
            'observacoesevento' => 'Chegar 1h antes',
            'paleto' => '48',
            'calca' => '42',
            'camisa' => 'M',
            'colete' => 'Sim',
            'manga' => 'Comprida',
            'barra_calca' => 'Normal',
            'modelo' => 'Slim',
            'cor' => 'Azul Marinho',
            'observacoesmedidas' => 'Ajuste na manga',
        ];

        $response = $this->post(route('noivos.store'), $dados);
        $response->assertRedirect(route('noivos.list'));
        $this->assertDatabaseHas('noivos', ['nome' => 'Carlos da Silva']);
    }

    /** @test */
    public function nao_deve_cadastrar_noivo_sem_nome()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $dados = [
            // 'nome' está ausente aqui
            'email' => 'semnome@email.com',
        ];

        try {
            $response = $this->post(route('noivos.store'), $dados);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->assertArrayHasKey('nome', $e->errors());
            $this->assertDatabaseMissing('noivos', ['email' => 'semnome@email.com']);
            return;
        }
        $this->fail('ValidationException não foi lançada para campo nome obrigatório.');
    }

    /** @test */
    public function deve_atualizar_um_noivo()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create(['nome' => 'João']);

        $response = $this->put(route('noivo.atualizar', $noivo->id), [
            'nome' => 'João Atualizado',
            'email' => 'joao@email.com'
        ]);

        $response->assertRedirect(route('noivos.list'));
        $this->assertDatabaseHas('noivos', ['nome' => 'João Atualizado']);
    }

    /** @test */
    public function deve_excluir_um_noivo()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();

        $response = $this->delete(route('noivos.destroy', $noivo->id));

        $response->assertRedirect(route('noivos.list'));
        $this->assertDatabaseMissing('noivos', ['id' => $noivo->id]);
    }

    /** @test */
    public function deve_mostrar_detalhes_do_noivo()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();

        $response = $this->get(route('noivos.show', $noivo->id));

        $response->assertStatus(200);
        $response->assertSee($noivo->nome);
    }
}
