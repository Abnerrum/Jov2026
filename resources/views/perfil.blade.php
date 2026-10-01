@extends('layouts.app')
@section('title', 'Minha conta — Jovify')
@section('content')
<span class="eyebrow">Minha conta</span><h1>Seus dados e sua senha</h1>
<div class="cards"><section class="card"><h2>Editar dados</h2><p>Confirme sua senha atual para salvar as alterações.</p>
<form method="POST" action="{{ route('perfil.update') }}" class="stack">@csrf @method('PATCH')
<label for="nome">Nome completo</label><input id="nome" name="nomeCompleto" maxlength="100" autocomplete="name" value="{{ old('nomeCompleto', $usuario->nomeCompleto) }}" required>
<label for="email">E-mail</label><input id="email" type="email" name="email" maxlength="100" autocomplete="email" value="{{ old('email', $usuario->email) }}" required>
<label for="senha-dados">Senha atual</label><input id="senha-dados" type="password" name="current_password" autocomplete="current-password" required>
<button type="submit">Salvar meus dados</button></form></section>
<section class="card"><h2>Trocar senha</h2><p>Depois da troca, você precisará entrar novamente.</p>
<form method="POST" action="{{ route('perfil.password') }}" class="stack">@csrf @method('PUT')
<label for="senha-atual">Senha atual</label><input id="senha-atual" type="password" name="current_password" autocomplete="current-password" required>
<label for="nova-senha">Nova senha</label><input id="nova-senha" type="password" name="password" autocomplete="new-password" minlength="8" required><small>Use pelo menos 8 caracteres e uma senha diferente da atual.</small>
<label for="confirma-senha">Confirme a nova senha</label><input id="confirma-senha" type="password" name="password_confirmation" autocomplete="new-password" minlength="8" required>
<button type="submit">Atualizar senha</button></form></section></div>
@endsection
