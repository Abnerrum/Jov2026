<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Jovify')</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<a class="skip" href="#conteudo">Pular para o conteúdo</a>
<header class="topbar"><a class="brand" href="{{ route('inicio') }}">Jovify<span>Conectando jovens ao futuro</span></a>
<nav aria-label="Menu principal">
@auth
<a href="{{ route('inicio') }}">Início</a><a href="{{ route('questionario') }}">Questionário</a>
<form method="POST" action="{{ route('logout') }}">@csrf<button class="secondary">Sair</button></form>
@else
<a href="{{ route('login') }}">Entrar</a><a href="{{ route('signup.form') }}">Criar conta</a>
@endauth
</nav></header>
<main id="conteudo" class="page">
@if(session('success'))<p class="notice" role="status">{{ session('success') }}</p>@endif
@if($errors->any())<div class="error" role="alert"><strong>Confira os campos:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@yield('content')
</main>
<footer>Jovify · Seu próximo passo começa aqui.</footer>
</body></html>
