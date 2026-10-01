@extends('layouts.app')
@section('title', 'Minha jornada — Jovify')
@section('content')
<section class="hero"><span class="eyebrow">Minha jornada</span><h1>Olá, {{ auth()->user()->nomeCompleto }}!</h1><p>Um espaço para conhecer suas preferências e acompanhar seu próximo passo.</p></section>
<div class="cards"><section class="card"><span class="badge">{{ $resposta ? 'Concluído' : 'Pendente' }}</span><h2>Seu questionário</h2><p>{{ $totalPerguntas }} perguntas sobre suas preferências. Você pode revisar suas respostas quando quiser.</p>
@if($resposta)<p>Última atualização: {{ $resposta->updated_at->timezone('America/Sao_Paulo')->format('d/m/Y H:i') }}.</p><a class="button" href="{{ route('questionario.conclusao') }}">Ver minhas respostas</a><p><a href="{{ route('questionario') }}">Revisar questionário</a></p>
@else<a class="button" href="{{ route('questionario') }}">Começar questionário</a>@endif
</section><section class="card"><h2>Minha conta</h2><dl><dt>Nome</dt><dd>{{ auth()->user()->nomeCompleto }}</dd><dt>E-mail</dt><dd>{{ auth()->user()->email }}</dd><dt>Conta criada em</dt><dd>{{ auth()->user()->created_at->format('d/m/Y') }}</dd></dl><a href="{{ route('perfil.edit') }}">Editar dados e senha</a></section></div>
@endsection
