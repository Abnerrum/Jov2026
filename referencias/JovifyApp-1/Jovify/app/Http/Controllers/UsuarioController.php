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

        $validator = Validator::make($request->all(), [
            'nomeCompleto' => 'required|string|max:100',
            'cpf' => 'required|string|max:11|unique:usuarios,cpf',
            'email' => 'required|email|max:100|unique:usuarios,email',
            'password' => 'required|confirmed|min:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        Usuario::create([
            'nomeCompleto' => $request->input('nomeCompleto'),
            'cpf' => $request->input('cpf'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('login')->with('success', 'Usuário cadastrado com sucesso!');
    }
}
