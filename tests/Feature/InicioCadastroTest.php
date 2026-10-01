<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InicioCadastroTest extends TestCase
{
    use RefreshDatabase;

    public function test_inicio_exige_login(): void
    {
        $this->get('/inicio')->assertRedirect(route('login'));
    }

    public function test_cadastro_normaliza_dados_e_mostra_inicio_pendente(): void
    {
        $this->post('/signup', [
            'nomeCompleto' => ' Pessoa Teste ', 'cpf' => '123.456.789-01',
            'email' => 'TESTE@JOVIFY.COM', 'password' => 'senha1234',
            'password_confirmation' => 'senha1234',
        ])->assertRedirect(route('login'));
        $usuario = Usuario::where('email', 'teste@jovify.com')->firstOrFail();
        $this->assertSame('12345678901', $usuario->cpf);
        $this->assertSame('Pessoa Teste', $usuario->nomeCompleto);
        $this->actingAs($usuario)->get('/inicio')->assertOk()->assertSee('Pendente');
        $this->get('/')->assertRedirect(route('inicio'));
        $this->post('/questionario', array_fill_keys(array_keys(config('questionario.perguntas')), 3));
        $this->get('/inicio')->assertOk()->assertSee('Concluído')->assertSee('Ver minhas respostas');
    }

    public function test_cadastro_rejeita_senha_curta_sem_guardar_senhas_em_old_input(): void
    {
        $this->from('/cadastro')->post('/signup', [
            'nomeCompleto' => 'Pessoa Teste', 'cpf' => '12345678901',
            'email' => 'teste@jovify.com', 'password' => '1234', 'password_confirmation' => '1234',
        ])->assertRedirect('/cadastro')->assertSessionHasErrors('password');
        $this->assertNull(session()->getOldInput('password'));
        $this->assertNull(session()->getOldInput('password_confirmation'));
        $this->assertDatabaseCount('usuarios', 0);
    }

    public function test_login_limita_tentativas_repetidas(): void
    {
        for ($tentativa = 0; $tentativa < 6; $tentativa++) {
            $this->post('/login', ['email' => 'naoexiste@jovify.com', 'password' => 'incorreta'])
                ->assertStatus(302);
        }
        $this->post('/login', ['email' => 'naoexiste@jovify.com', 'password' => 'incorreta'])
            ->assertStatus(429);
    }
}
