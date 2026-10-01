<?php

namespace Tests\Feature;

use App\Models\Usuario;
use App\Models\RespostaQuestionario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class QuestionarioTest extends TestCase
{
    use RefreshDatabase;

    private function usuario(string $email = 'teste@jovify.com', string $cpf = '12345678901'): Usuario
    {
        return Usuario::create(['nomeCompleto' => 'Pessoa Teste', 'cpf' => $cpf,
            'email' => $email, 'password' => Hash::make('senha1234')]);
    }

    private function respostas(): array
    {
        return array_fill_keys(array_keys(config('questionario.perguntas')), 3);
    }

    public function test_visitante_nao_pode_acessar_ou_enviar(): void
    {
        $this->get('/questionario')->assertRedirect('/login');
        $this->post('/questionario', $this->respostas())->assertRedirect('/login');
        $this->get('/questionario/conclusao')->assertRedirect('/login');
        $this->assertDatabaseCount('respostas_questionario', 0);
    }

    public function test_respostas_sao_vinculadas_ao_usuario_da_sessao(): void
    {
        $usuario = $this->usuario();
        $outro = $this->usuario('outro@jovify.com', '12345678902');
        $this->actingAs($usuario)->post('/questionario', $this->respostas() + ['usuario_id' => $outro->id])
            ->assertRedirect(route('questionario.conclusao'));
        $this->assertDatabaseHas('respostas_questionario', ['usuario_id' => $usuario->id]);
        $this->assertDatabaseMissing('respostas_questionario', ['usuario_id' => $outro->id]);
        $this->assertSame($this->respostas(), RespostaQuestionario::first()->respostas);
        $this->get('/questionario/conclusao')->assertOk()->assertSee('Questionário concluído!');
    }

    public function test_respostas_incompletas_e_fora_da_escala_nao_sao_salvas(): void
    {
        $this->actingAs($this->usuario())->post('/questionario', ['q1' => 99])
            ->assertSessionHasErrors(['q1', 'q2']);
        $this->assertDatabaseCount('respostas_questionario', 0);
    }

    public function test_reenvio_atualiza_sem_duplicar(): void
    {
        $this->actingAs($this->usuario());
        $this->post('/questionario', $this->respostas());
        $respostas = $this->respostas();
        $respostas['q1'] = 1;
        $this->post('/questionario', $respostas)->assertRedirect(route('questionario.conclusao'));
        $this->assertDatabaseCount('respostas_questionario', 1);
        $this->assertSame(1, RespostaQuestionario::first()->respostas['q1']);
        $this->get('/questionario')->assertOk();
    }

    public function test_conclusao_nao_mostra_respostas_de_outra_pessoa(): void
    {
        $this->actingAs($this->usuario())->post('/questionario', $this->respostas());
        $this->actingAs($this->usuario('outro@jovify.com', '12345678902'))
            ->get('/questionario/conclusao')->assertRedirect(route('questionario'));
    }

    public function test_login_valido_e_logout(): void
    {
        $usuario = $this->usuario();
        $this->post('/login', ['email' => $usuario->email, 'password' => 'senha1234'])
            ->assertRedirect(route('questionario'));
        $this->assertAuthenticatedAs($usuario);
        $this->post('/logout')->assertRedirect(route('login'));
        $this->assertGuest();
        $this->get('/questionario')->assertRedirect(route('login'));
    }

    public function test_login_invalido_retorna_erro_no_formulario(): void
    {
        $usuario = $this->usuario();
        $this->from('/login')->post('/login', ['email' => $usuario->email, 'password' => 'errada'])
            ->assertRedirect('/login')->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
