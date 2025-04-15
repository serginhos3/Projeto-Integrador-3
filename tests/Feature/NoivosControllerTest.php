<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Noivo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoivosControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_listar_noivos()
    {
        $response = $this->get(route('noivos.list'));

        $response->assertStatus(200)
            ->assertViewIs('noivos.list');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_tela_de_cadastro_de_noivo_esta_acessivel()
    {
        $response = $this->get(route('noivos.cadastrar'));

        $response->assertStatus(200)
            ->assertViewIs('noivos.cadastrar');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_cadastrar_novo_noivo()
    {
        $response = $this->post(route('noivos.store'), [
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

        $response->assertRedirect(route('noivos.list'))
            ->assertSessionHas('status', 'Noivo cadastrado com sucesso!');
        $this->assertDatabaseHas('noivos', ['email' => 'noivo@teste.com']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_tela_de_edicao_de_noivo_esta_acessivel()
    {

        $response = $this->post(route('noivos.store'), [
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

        $noivo = \App\Models\Noivo::where('email', 'noivo@teste.com')->first();

        $response = $this->get(route('noivos.editar', $noivo->id));

        $response->assertStatus(200)
            ->assertViewIs('noivos.editar');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_atualizar_noivo()
    {

        $noivo = Noivo::create([
            'nome' => 'Noivo Antigo',
            'email' => 'antigo@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua Antiga',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro Antigo',
            'cidade' => 'Cidade Antiga',
            'estado' => 'SP',
            'datadoevento' => '1990-01-01',
        ]);

        $response = $this->put(route('noivos.atualizar', $noivo->id), [
            'nome' => 'Noivo Atualizado',
            'email' => 'atualizado@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '87654321',
            'logradouro' => 'Rua Atualizada',
            'numero' => '321',
            'complemento' => 'Apto 2',
            'bairro' => 'Bairro Atualizado',
            'cidade' => 'Cidade Atualizada',
            'estado' => 'RJ',
            'datadoevento' => '1990-01-01',
        ]);

        $response->assertRedirect(route('noivos.list'))
            ->assertSessionHas('status', 'Noivo atualizado com sucesso!');

        $this->assertDatabaseHas('noivos', [
            'id' => $noivo->id,
            'nome' => 'Noivo Atualizado',
            'email' => 'atualizado@teste.com'
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function test_excluir_noivo()
    {

        $noivo = Noivo::create([
            'nome' => 'Noivo a Excluir',
            'email' => 'excluir@teste.com',
            'telefone' => '11 12345-6789',
            'cep' => '12345678',
            'logradouro' => 'Rua a Excluir',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'bairro' => 'Bairro a Excluir',
            'cidade' => 'Cidade a Excluir',
            'estado' => 'SP',
            'datadoevento' => '1990-01-01',
        ]);

        $response = $this->delete(route('noivos.destroy', $noivo->id));

        $response->assertRedirect(route('noivos.list'))
            ->assertSessionHas('status', 'Noivo excluído com sucesso!');

        $this->assertDatabaseMissing('noivos', ['id' => $noivo->id]);
    }
}
