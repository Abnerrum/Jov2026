<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Questionário concluído — Jovify</title>
    <link rel="stylesheet" href="{{ asset('css/questionario.css') }}">
</head>
<body>
<main class="container">
    <header><span class="logo">Jovify</span><form method="POST" action="{{ route('logout') }}">@csrf<button class="secondary">Sair</button></form></header>
    <h1>Questionário concluído!</h1>
    <p>{{ auth()->user()->nomeCompleto }}, suas respostas foram salvas.</p>
    <p>Último envio: {{ $resposta->updated_at->timezone('America/Sao_Paulo')->format('d/m/Y H:i') }}.</p>
    <ol>
    @foreach ($perguntas as $campo => $pergunta)
        <li><p>{{ $pergunta }}<br><strong>Resposta: {{ $resposta->respostas[$campo] }}</strong></p></li>
    @endforeach
    </ol>
    <a class="button" href="{{ route('questionario') }}">Revisar respostas</a>
</main>
</body>
</html>
