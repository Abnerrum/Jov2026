<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Questionário — Jovify</title>
    <link rel="stylesheet" href="{{ asset('css/questionario.css') }}">
</head>
<body>
<main class="container">
    <header><a href="{{ route('inicio') }}">Início</a><a href="{{ route('questionario') }}" class="logo">Jovify</a>
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="secondary">Sair</button></form>
    </header>
    <h1>Conte um pouco sobre você</h1>
    <p>Olá, {{ auth()->user()->nomeCompleto }}! Responda às oito perguntas para concluir seu questionário.</p>
    <p>1 = Discordo totalmente · 2 = Discordo · 3 = Concordo · 4 = Concordo totalmente</p>
    @if ($resposta)<p class="notice">Você já respondeu. Ao enviar novamente, suas respostas serão atualizadas.</p>@endif
    @if ($errors->any())
        <div class="error" role="alert"><strong>Confira suas respostas:</strong><ul>
        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul></div>
    @endif
    <noscript><p>Responda a todas as perguntas e clique em salvar. O contador de progresso requer JavaScript.</p></noscript>
    <div><label for="progresso-questionario">Seu progresso</label><progress id="progresso-questionario" max="{{ count($perguntas) }}" value="0" style="width:100%"></progress><p id="texto-progresso" role="status" aria-live="polite"></p><small>Suas respostas são gravadas quando você clica em salvar.</small></div>
    <form method="POST" action="{{ route('questionario.store') }}" data-questionario>
        @csrf
        @foreach ($perguntas as $campo => $pergunta)
        <fieldset>
            <legend>{{ $loop->iteration }}. {{ $pergunta }}</legend>
            <div class="options">
            @foreach ([1 => 'Discordo totalmente', 2 => 'Discordo', 3 => 'Concordo', 4 => 'Concordo totalmente'] as $valor => $rotulo)
                <label><input type="radio" name="{{ $campo }}" value="{{ $valor }}" required
                    @checked((string) old($campo, $resposta?->respostas[$campo] ?? '') === (string) $valor)>
                    <span>{{ $valor }} — {{ $rotulo }}</span></label>
            @endforeach
            </div>
            @error($campo)<p class="error">{{ $message }}</p>@enderror
        </fieldset>
        @endforeach
        <button type="submit">Salvar respostas e concluir</button>
    </form>
</main>
<script src="{{ asset('js/questionario.js') }}" defer></script>
</body>
</html>
