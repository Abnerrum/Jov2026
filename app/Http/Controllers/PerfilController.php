<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    public function edit(Request $request)
    {
        return view('perfil', ['usuario' => $request->user()]);
    }

    public function update(Request $request)
    {
        $usuario = $request->user();
        $dados = $request->only('nomeCompleto', 'email', 'current_password');
        if (is_string($dados['nomeCompleto'] ?? null)) {
            $dados['nomeCompleto'] = trim($dados['nomeCompleto']);
        }
        if (is_string($dados['email'] ?? null)) {
            $dados['email'] = strtolower(trim($dados['email']));
        }
        $validator = Validator::make($dados, [
            'nomeCompleto' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', Rule::unique('usuarios', 'email')->ignore($usuario->id)],
            'current_password' => ['required', 'string', 'current_password:web'],
        ], [
            'email.unique' => 'Este e-mail já está cadastrado.',
            'current_password.required' => 'Confirme sua senha atual para salvar.',
            'current_password.current_password' => 'A senha atual não confere.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(collect($dados)->except('current_password')->all());
        }
        $usuario->update(collect($validator->validated())->only('nomeCompleto', 'email')->all());

        return redirect()->route('perfil.edit')->with('success', 'Seus dados foram atualizados.');
    }

    public function password(Request $request)
    {
        $validator = Validator::make($request->only('current_password', 'password', 'password_confirmation'), [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ], [
            'current_password.current_password' => 'A senha atual não confere.',
            'password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da nova senha não confere.',
            'password.different' => 'Escolha uma senha diferente da atual.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $request->user()->forceFill([
            'password' => Hash::make($validator->validated()['password']),
            'remember_token' => Str::random(60),
        ])->save();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Senha atualizada. Entre novamente com sua nova senha.');
    }
}
