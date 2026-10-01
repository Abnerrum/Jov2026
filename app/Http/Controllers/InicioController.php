<?php

namespace App\Http\Controllers;

use App\Models\RespostaQuestionario;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(Request $request)
    {
        return view('inicio', [
            'resposta' => RespostaQuestionario::where('usuario_id', $request->user()->id)->first(),
            'totalPerguntas' => count(config('questionario.perguntas')),
        ]);
    }
}
