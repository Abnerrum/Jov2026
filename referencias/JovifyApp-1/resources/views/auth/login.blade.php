<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Jovify</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  </head>
  <body class="index">
    <div class="container">
      <div class="logo">Jovify</div>
      <div class="slogan">Conectando jovens ao futuro!</div>
      <form class="form" action="{{ route('login.post') }}" method="POST">
        @csrf
        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
        <input type="text" name="email" placeholder="E-mail" required/>
        <input type="password" name="password" placeholder="Senha" required />
        <div class="row mt-3 mb-2">
            <div class="col-12 d-flex justify-content-between">
                <div class="col-6"><button type="submit" class="btn">Entrar</button>
                </div>
                <div class="col-6"><a href="/cadastro" class="btn my-auto">Cadastrar</a></div>
            </div>
        </div>
        <a href="#" class="forgot-password">Esqueci minha senha</a>
      </form>
    </div>
  </body>
</html>
