<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
    
        if (Auth::attempt($credentials)) {
            $usuario = Auth::user();
            $token = Str::random(60);
            $usuario->remember_token = $token;
            $usuario->save();
    

            $request->session()->put('token', $token);
    
     
            return redirect()->route('questionario');
        }
    
        return response()->json(['error' => 'Email ou senha incorretos.'], 401);
    }    
}