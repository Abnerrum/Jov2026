<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    // Mostrar o formulário de cadastro
    public function showForm()
    {
        return view('auth/cadastro');
    }

    // Processar o cadastro do usuário
    public function register(Request $request)
    {

        $request->merge([
            'cpf' => preg_replace('/[.\-\s]/', '', (string) $request->input('cpf')),
            'email' => strtolower(trim((string) $request->input('email'))),
            'nomeCompleto' => trim((string) $request->input('nomeCompleto')),
        ]);

        $validator = Validator::make($request->all(), [
            'nomeCompleto' => 'required|string|max:100',
            'cpf' => 'required|digits:11|unique:usuarios,cpf',
            'email' => 'required|email|max:100|unique:usuarios,email',
            'password' => 'required|string|confirmed|min:8',
        ], [
            'cpf.digits' => 'Digite os 11 números do CPF.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'email.email' => 'Digite um e-mail válido.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput($request->except('password', 'password_confirmation'));
        }

        Usuario::create([
            'nomeCompleto' => $request->input('nomeCompleto'),
            'cpf' => $request->input('cpf'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso! Faça login para continuar.');
    }
}
