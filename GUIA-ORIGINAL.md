# Jovify

Aplicação web em **Laravel 11** para cadastro e login de usuários, com acesso a um questionário após autenticação. Slogan do projeto: *"Conectando jovens ao futuro!"*

## Funcionalidades

- Cadastro de usuário (nome completo, CPF, e-mail e senha) com validação.
- Login com autenticação via sessão e geração de `remember_token`.
- Área de questionário protegida por autenticação (`middleware('auth')`).
- Logout.

## Tecnologias

- PHP 8.2+
- Laravel 11
- Bootstrap 4.5 (via CDN) nas telas de cadastro e login
- Banco de dados relacional (MySQL, PostgreSQL ou SQLite)

## Estrutura

- `app/Http/Controllers/UsuarioController.php` — cadastro de usuários.
- `app/Http/Controllers/LoginController.php` — login/logout.
- `app/Http/Controllers/QuestionarioController.php` — questionário.
- `app/Models/Usuario.php` — model de usuário (tabela `usuarios`).
- `database/migrations/` — criação da tabela `usuarios`.
- `resources/views/auth/` — telas de cadastro e login (Blade).
- `routes/web.php` — rotas da aplicação.

## Como rodar localmente

Pré-requisitos: PHP 8.2+, Composer e um banco de dados.

```bash
# 1. Instalar dependências
composer install

# 2. Criar o arquivo de ambiente
cp .env.example .env

# 3. Gerar a chave da aplicação
php artisan key:generate

# 4. Configurar o banco no .env (DB_CONNECTION, DB_DATABASE, etc.)
#    Para testar rápido, use SQLite:
#      DB_CONNECTION=sqlite
#    e crie o arquivo:
#      touch database/database.sqlite

# 5. Rodar as migrations
php artisan migrate

# 6. (opcional) Popular um usuário de demonstração
php artisan db:seed
#    -> e-mail: demo@jovify.com | senha: demo1234

# 7. Subir o servidor
php artisan serve
```

Acesse `http://localhost:8000`. A rota inicial `/` redireciona para o login.

## Rotas principais

| Método | URI            | Nome               | Descrição                          |
|--------|----------------|--------------------|------------------------------------|
| GET    | `/`            | —                  | Redireciona para o login           |
| GET    | `/cadastro`    | `signup.form`      | Formulário de cadastro             |
| POST   | `/signup`      | `signup.register`  | Processa o cadastro                |
| GET    | `/login`       | `login`            | Formulário de login                |
| POST   | `/login`       | `login.post`       | Processa o login                   |
| GET    | `/questionario`| `questionario`     | Questionário (requer autenticação) |
| POST   | `/logout`      | `logout`           | Encerra a sessão                   |

## Correções aplicadas nesta versão

- Migration: chave primária corrigida (`$table->id()` — antes criava a coluna com nome `usuasrio`).
- Cadastro: redirecionamento após registrar apontava para uma rota inexistente; agora leva ao login com mensagem de sucesso.
- Login: em caso de falha, volta ao formulário com mensagem de erro (antes retornava JSON 401, quebrando o fluxo web).
- `TokenMiddleware`: importação de `Request` adicionada e consulta corrigida para o model `Usuario` (antes usava `Auth::where`, inválido).
- `DatabaseSeeder`: deixou de referenciar o model inexistente `App\Models\User`; agora cria um usuário de demonstração usando `Usuario`.
