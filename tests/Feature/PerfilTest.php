<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PerfilTest extends TestCase
{
    use RefreshDatabase;

    private function usuario(string $email = 'teste@jovify.com', string $cpf = '12345678901'): Usuario
    {
        return Usuario::create(['nomeCompleto' => 'Pessoa Teste', 'email' => $email,
            'cpf' => $cpf, 'password' => Hash::make('senha1234')]);
    }

    public function test_visitante_nao_pode_abrir_ou_alterar_perfil(): void
    {
        $this->get('/minha-conta')->assertRedirect(route('login'));
        $this->patch('/minha-conta', [])->assertRedirect(route('login'));
        $this->put('/minha-conta/senha', [])->assertRedirect(route('login'));
    }

    public function test_edicao_altera_apenas_usuario_autenticado(): void
    {
        $usuario = $this->usuario();
        $outro = $this->usuario('outro@jovify.com', '12345678902');
        $this->actingAs($usuario)->get('/minha-conta')->assertOk();
        $this->patch('/minha-conta', ['nomeCompleto' => ' Novo Nome ', 'email' => 'NOVO@JOVIFY.COM',
            'current_password' => 'senha1234', 'id' => $outro->id, 'cpf' => '99999999999'])
            ->assertRedirect(route('perfil.edit'));
        $this->assertSame('Novo Nome', $usuario->fresh()->nomeCompleto);
        $this->assertSame('novo@jovify.com', $usuario->fresh()->email);
        $this->assertSame('12345678901', $usuario->fresh()->cpf);
        $this->assertSame('Pessoa Teste', $outro->fresh()->nomeCompleto);
    }

    public function test_senha_incorreta_e_email_duplicado_impedem_edicao(): void
    {
        $usuario = $this->usuario();
        $this->usuario('outro@jovify.com', '12345678902');
        $this->actingAs($usuario)->from('/minha-conta')->patch('/minha-conta', [
            'nomeCompleto' => 'Mudado', 'email' => 'outro@jovify.com', 'current_password' => 'errada',
        ])->assertSessionHasErrors(['email', 'current_password']);
        $this->assertSame('Pessoa Teste', $usuario->fresh()->nomeCompleto);
        $this->assertNull(session()->getOldInput('current_password'));
    }

    public function test_troca_senha_exige_senha_atual_e_confirmacao(): void
    {
        $usuario = $this->usuario();
        $this->actingAs($usuario)->from('/minha-conta')->put('/minha-conta/senha', [
            'current_password' => 'errada', 'password' => 'nova12345', 'password_confirmation' => 'outra12345',
        ])->assertSessionHasErrors(['current_password', 'password']);
        $this->assertTrue(Hash::check('senha1234', $usuario->fresh()->password));
    }

    public function test_senha_e_atualizada_e_usuario_precisa_entrar_novamente(): void
    {
        $usuario = $this->usuario();
        $this->actingAs($usuario)->put('/minha-conta/senha', [
            'current_password' => 'senha1234', 'password' => 'nova12345', 'password_confirmation' => 'nova12345',
        ])->assertRedirect(route('login'));
        $this->assertGuest();
        $this->assertTrue(Hash::check('nova12345', $usuario->fresh()->password));
        $this->post('/login', ['email' => $usuario->email, 'password' => 'senha1234'])->assertSessionHasErrors('email');
        $this->post('/login', ['email' => $usuario->email, 'password' => 'nova12345'])->assertRedirect(route('inicio'));
        $this->assertAuthenticatedAs($usuario);
    }
}
