<?php

namespace Tests\Feature;

use App\Models\Padrinho;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PadrinhoTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_padrinho(): void
    {
        $padrinho = Padrinho::factory()->create();
        $this->assertDatabaseHas('padrinhos', ['id' => $padrinho->id]);
    }

    public function test_editar_padrinho(): void
    {
        $padrinho = Padrinho::factory()->create();
        $padrinho->nome = 'Novo Nome';
        $padrinho->save();
        $this->assertEquals('Novo Nome', $padrinho->fresh()->nome);
    }

    public function test_excluir_padrinho(): void
    {
        $padrinho = Padrinho::factory()->create();
        $padrinho->delete();
        $this->assertSoftDeleted($padrinho);
    }

    public function test_relacionamento_pedidos(): void
    {
        $padrinho = Padrinho::factory()->create();
        $this->assertIsIterable($padrinho->pedidos);
    }

    public function test_status_do_padrinho(): void
    {
        $padrinho = Padrinho::factory()->create(['status' => 'ativo']);
        $this->assertEquals('ativo', $padrinho->status);
    }
}
