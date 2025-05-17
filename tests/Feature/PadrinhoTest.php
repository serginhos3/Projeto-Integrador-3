<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Padrinho;
use App\Models\Noivo;
use App\Models\User;

class PadrinhoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function deve_cadastrar_um_padrinho_com_dados_validos()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();
        $dados = [
            'nome' => 'José Padrinho',
            'telefone' => '11988887777',
            'email' => 'josepadrinho@email.com',
            'status' => 'ativo',
            'noivo_id' => $noivo->id,
        ];
        $response = $this->post(route('padrinhos.store'), $dados);
        $response->assertRedirect(route('padrinhos.list'));
        $this->assertDatabaseHas('padrinhos', ['nome' => 'José Padrinho']);
    }

    /** @test */
    public function nao_deve_cadastrar_padrinho_sem_nome()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();
        $dados = [
            'email' => 'semnomepadrinho@email.com',
            'noivo_id' => $noivo->id,
        ];
        $response = $this->post(route('padrinhos.store'), $dados);
        $response->assertSessionHasErrors('nome');
        $this->assertDatabaseMissing('padrinhos', ['email' => 'semnomepadrinho@email.com']);
    }

    /** @test */
    public function deve_atualizar_um_padrinho()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();
        $padrinho = Padrinho::create([
            'nome' => 'Antônio',
            'email' => 'antonio@email.com',
            'noivo_id' => $noivo->id,
        ]);
        $response = $this->put(route('padrinhos.atualizar', $padrinho->id), [
            'nome' => 'Antônio Atualizado',
            'email' => 'antonio@email.com',
            'noivo_id' => $noivo->id,
        ]);
        $response->assertRedirect(route('padrinhos.list'));
        $this->assertDatabaseHas('padrinhos', ['nome' => 'Antônio Atualizado']);
    }

    /** @test */
    public function deve_excluir_um_padrinho()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();
        $padrinho = Padrinho::create([
            'nome' => 'Carlos',
            'email' => 'carlos@email.com',
            'noivo_id' => $noivo->id,
        ]);
        $response = $this->delete(route('padinhos.destroy', $padrinho->id));
        $response->assertRedirect(route('padrinhos.list'));
        $this->assertDatabaseMissing('padrinhos', ['id' => $padrinho->id]);
    }

    /** @test */
    public function deve_mostrar_detalhes_do_padrinho()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $noivo = Noivo::factory()->create();
        $padrinho = Padrinho::create([
            'nome' => 'Pedro',
            'email' => 'pedro@email.com',
            'noivo_id' => $noivo->id,
        ]);
        $response = $this->get(route('padrinhos.show', $padrinho->id));
        $response->assertStatus(200);
        $response->assertSee($padrinho->nome);
    }
}
