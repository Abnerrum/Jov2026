@extends('layouts.app')
@section('title', 'Entrar — Jovify')
@section('content')
<section class="auth-card"><span class="eyebrow">Bem-vindo de volta</span><h1>Continue sua jornada</h1><p>Entre na sua conta para responder e revisar seu questionário.</p>
<form method="POST" action="{{ route('login.post') }}" class="stack">@csrf
<label for="email">E-mail</label><input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" maxlength="100" required>
<label for="password">Senha</label><input id="password" type="password" name="password" autocomplete="current-password" required>
<button type="submit">Entrar</button></form>
<p>Ainda não tem conta? <a href="{{ route('signup.form') }}">Cadastre-se</a>.</p></section>
@endsection
