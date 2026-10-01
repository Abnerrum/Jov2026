<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro de Usuário - Jovify</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="cadastro">
    <div class="container w-auto py-auto my-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <h2 class="py-auto text-center logo">Cadastro de Usuário</h2>
                <form id="signupForm" action="{{ route('signup.register') }}" method="POST" class="needs-validation p-2 form" novalidate>
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
                    
                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                          <input type="text" class="form-control" id="fullName" name="nomeCompleto" value="{{ old('nomeCompleto') }}" required placeholder="Nome Completo"/>
                        </div>
                        <div class="form-group col-md-6 required">
                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" required placeholder="CPF"/>
                        </div>
                    </div>
                    
                    <div class="form-group required">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="E-mail"/>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <input type="password" class="form-control" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}" placeholder="Senha"/>
                        </div>
                        <div class="form-group col-md-6 required">
                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirmar Senha"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input m-1" type="checkbox" id="termsCheck" required/>
                            <label class="form-check-label text-nowrap" for="termsCheck">
                                Concordo com os <a href="#">termos e condições</a>.
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-cadastrar">
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
