<?php

namespace Tests\Feature;

use App\Models\Noivo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoivoTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_noivo(): void
    {
        $noivo = Noivo::factory()->create();
        $this->assertDatabaseHas('noivos', ['id' => $noivo->id]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_editar_noivo(): void
    {
        $noivo = Noivo::factory()->create();
        $noivo->nome = 'Novo Nome';
        $noivo->save();
        $this->assertEquals('Novo Nome', $noivo->fresh()->nome);
    }

    public function test_excluir_noivo(): void
    {
        $noivo = Noivo::factory()->create();
        $noivo->delete();
        $this->assertSoftDeleted($noivo);
    }
}
