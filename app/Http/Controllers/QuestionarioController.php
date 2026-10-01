<?php

namespace App\Http\Controllers;

use App\Models\RespostaQuestionario;
use Illuminate\Http\Request;

class QuestionarioController extends Controller
{
    public function index(Request $request)
    {
        return view('questionario', [
            'perguntas' => config('questionario.perguntas'),
            'resposta' => RespostaQuestionario::where('usuario_id', $request->user()->id)->first(),
        ]);
    }

    public function store(Request $request)
    {
        $rules = [];
        $messages = [];
        foreach (config('questionario.perguntas') as $campo => $pergunta) {
            $rules[$campo] = ['required', 'integer', 'in:1,2,3,4'];
            $messages[$campo.'.required'] = 'Responda à pergunta '.substr($campo, 1).'.';
            $messages[$campo.'.in'] = 'Escolha uma opção de 1 a 4.';
        }
        $respostas = $request->validate($rules, $messages);
        $respostas = array_map('intval', $respostas);

        RespostaQuestionario::updateOrCreate(
            ['usuario_id' => $request->user()->id],
            ['respostas' => $respostas],
        );

        return redirect()->route('questionario.conclusao');
    }

    public function conclusao(Request $request)
    {
        $resposta = RespostaQuestionario::where('usuario_id', $request->user()->id)->first();
        if (!$resposta) {
            return redirect()->route('questionario');
        }

        return view('questionario-conclusao', [
            'resposta' => $resposta,
            'perguntas' => config('questionario.perguntas'),
        ]);
    }
}
