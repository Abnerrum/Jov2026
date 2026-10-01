@extends('layouts.app')
@section('title', 'Criar conta — Jovify')
@section('content')
<section class="auth-card"><span class="eyebrow">Comece por aqui</span><h1>Crie sua conta</h1><p>Preencha seus dados para começar a usar o Jovify.</p>
<form method="POST" action="{{ route('signup.register') }}" class="stack">@csrf
<label for="nome">Nome completo</label><input id="nome" name="nomeCompleto" value="{{ old('nomeCompleto') }}" autocomplete="name" maxlength="100" required>
<label for="cpf">CPF</label><input id="cpf" name="cpf" value="{{ old('cpf') }}" inputmode="numeric" maxlength="14" placeholder="000.000.000-00" aria-describedby="cpf-ajuda" required><small id="cpf-ajuda">Digite os 11 números, com ou sem pontuação.</small>
<label for="email">E-mail</label><input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" maxlength="100" required>
<label for="password">Senha</label><input id="password" type="password" name="password" autocomplete="new-password" minlength="8" aria-describedby="senha-ajuda" required><small id="senha-ajuda">Use pelo menos 8 caracteres.</small>
<label for="confirmation">Confirme a senha</label><input id="confirmation" type="password" name="password_confirmation" autocomplete="new-password" minlength="8" required>
<button type="submit">Criar conta</button></form>
<p>Já tem conta? <a href="{{ route('login') }}">Entrar</a>.</p></section>
@endsection
