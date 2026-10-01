# Jovify — guia passo a passo

## 1. Código no GitHub

O README original do repositório foi preservado. O README que veio no ZIP está em GUIA-ORIGINAL.md. Este projeto usa Laravel 11 e PHP 8.2 ou superior, model Usuario e tabela usuarios.

Para obter a versão preparada, abra o terminal do VS Code em uma pasta onde você guarda seus projetos:

```bash
git clone https://github.com/Abnerrum/Jov2026.git
cd Jov2026
```

`git clone` baixa o projeto e seu histórico; `cd` entra na pasta. Depois abra essa pasta no VS Code.

### Como subir um ZIP descompactado manualmente

Esta é uma alternativa ao clone acima. Não faça novamente se já clonou.

Abra a pasta onde estão artisan e composer.json. Renomeie o README.md local para GUIA-ORIGINAL.md antes de começar, para não conflitar com o README do GitHub. Confira o .gitignore: não envie .env, vendor, node_modules ou arquivos database/*.sqlite.

```bash
git init
git branch -M main
git config user.name "Abner Luiz Pascoal de Oliveira"
git config user.email "abnerluizpascoal@gmail.com"
git add .
git status
git commit -m "Adiciona aplicativo Jovify"
git remote add origin https://github.com/Abnerrum/Jov2026.git
git pull origin main --allow-unrelated-histories --no-rebase --no-edit
git push -u origin main
```

- `git init`: cria o controle de versões na pasta.
- `git branch -M main`: chama a branch principal de main.
- `git config`: identifica o autor dos commits neste projeto.
- `git add .`: prepara os arquivos permitidos pelo .gitignore.
- `git status`: confira os arquivos antes de registrar o commit.
- `git commit`: registra uma versão local.
- `git remote add`: associa a pasta ao repositório existente.
- `git pull ... --allow-unrelated-histories`: junta o histórico do ZIP ao histórico já existente no GitHub. `--no-rebase` faz a união por merge; `--no-edit` aceita a mensagem padrão.
- `git push -u`: envia e configura a ligação com main.

Se aparecer qualquer conflito ou erro no pull, pare e resolva antes do push. Não use `--force`. Se origin já existir, confira `git remote -v` antes de mudar qualquer endereço. O GitHub pode abrir uma autenticação pelo navegador; não use sua senha da conta como senha de Git.

## 2. Rodar no computador

No terminal, dentro da pasta do projeto, confira:

```bash
php --version
composer --version
```

É necessário PHP 8.2 ou superior, Composer e as extensões exigidas pelo Laravel, incluindo pdo_sqlite e sqlite3. Se algum comando não for reconhecido, instale/configure a ferramenta antes de continuar.

Execute um comando por vez:

```bash
composer install
```

Instala as dependências nas versões do composer.lock e cria vendor/. Não substitua por composer update.

No Git Bash/Linux/macOS:

```bash
cp .env.example .env
```

No PowerShell do Windows, o equivalente é:

```powershell
Copy-Item .env.example .env
```

Cria suas configurações locais. Faça isso somente se ainda não existir .env, para não sobrescrever configurações suas.

```bash
php artisan key:generate
```

Gera a chave usada pelo Laravel para criptografia. Não publique o .env.

Crie o arquivo SQLite vazio com este comando, que funciona também no Windows e preserva um arquivo existente:

```bash
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
```

No .env, confirme estas linhas:

```dotenv
APP_NAME=Jovify
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Remova ou comente qualquer linha ativa DB_DATABASE ou DB_URL herdada de outra configuração. O config/database.php já usa database/database.sqlite por padrão. Não é necessário instalar MySQL.

```bash
php artisan config:clear
php artisan migrate
php artisan db:seed
php artisan serve
```

- `config:clear`: descarta configurações antigas em cache.
- `migrate`: cria usuarios e respostas_questionario. Não use migrate:fresh em um banco com dados que queira preservar.
- `db:seed`: cria o usuário demo, se ainda não existir.
- `serve`: inicia o servidor local; mantenha o terminal aberto. Ctrl+C encerra.

Abra http://127.0.0.1:8000 e use:

- E-mail: demo@jovify.com
- Senha: demo1234

Essa conta é apenas para teste local. O formulário usa CSS de public/, então não precisa de npm para o questionário. Cadastro/login mantêm os estilos existentes, com recursos externos.

## 3. Como o questionário funciona

Mantivemos as oito perguntas do formulário original. Todas agora têm nomes diferentes (q1 a q8), com escala de 1 a 4:

1. Discordo totalmente.
2. Discordo.
3. Concordo.
4. Concordo totalmente.

Os valores antigos -1, 0, 1 e 2 foram substituídos pela escala exibida. Não havia implementação de gravação anterior.

### Migration

`database/migrations/2026_10_01_000001_create_respostas_questionario_table.php` cria:

- id: identifica o registro.
- usuario_id: referência a usuarios.id, única por usuário.
- respostas: JSON com q1 a q8.
- created_at e updated_at: datas de criação e última atualização.

A chave estrangeira impede respostas sem usuário. Ao excluir um usuário, suas respostas também são excluídas. Um novo envio atualiza o registro existente, sem duplicar.

### Model

`app/Models/RespostaQuestionario.php` aponta para respostas_questionario, define os campos permitidos e converte o JSON para array. O relacionamento usuario usa App\Models\Usuario.

### Perguntas

`config/questionario.php` é a lista compartilhada pela validação e pelas telas. Você pode editar o texto sem alterar o restante do fluxo. Se adicionar novas perguntas, atualize também as instruções e planeje como lidar com registros anteriores.

### Rotas

Em `routes/web.php`:

- GET /questionario: mostra o formulário.
- POST /questionario: valida e salva.
- GET /questionario/conclusao: mostra somente as respostas de quem está logado.

As três usam middleware auth. A rota de saída recebe POST e token CSRF.

### Controller

`QuestionarioController@index` busca as respostas anteriores do usuário.

`store` exige todas as perguntas e aceita somente números inteiros de 1 a 4. O usuario_id vem da sessão autenticada, nunca do formulário. updateOrCreate salva ou atualiza o registro e redireciona para a conclusão.

`conclusao` busca somente as respostas do usuário atual. Se ele não respondeu, volta ao questionário. Não há cálculo de perfil ou diagnóstico: a tela confirma o envio e exibe as respostas.

### Views

`resources/views/questionario.blade.php` contém o formulário POST com @csrf, erros de validação e respostas anteriores. `old()` recupera os campos após um erro.

`resources/views/questionario-conclusao.blade.php` mostra a confirmação, as respostas e o link para revisá-las.

### Login e logout

O provider de autenticação já estava configurado para Usuario e foi mantido. O login agora regenera a sessão após autenticar. O método logout foi adicionado: encerra a autenticação, invalida a sessão e renova o token CSRF. As correções que já vieram no ZIP foram mantidas.

## 4. Conferir o funcionamento

Depois de instalar e configurar:

```bash
php artisan test
```

Os testes usam SQLite em memória, separado do banco local, e cobrem acesso sem login, gravação vinculada à sessão, validação, atualização sem duplicatas, isolamento das respostas entre usuários, login válido/inválido e logout.

Faça também o teste manual:

1. Acesse /questionario sem login: deve voltar ao login.
2. Entre com a conta demo.
3. Responda às oito perguntas e envie.
4. Confira a conclusão.
5. Revise uma resposta e envie novamente.
6. Clique em Sair e tente abrir o questionário.
7. Cadastre outro usuário e confirme que ele não vê as respostas do demo.

Limite da verificação: o ambiente de preparação não tem PHP nem Composer, portanto os testes Laravel não foram executados nele. Execute-os localmente antes de considerar a aplicação validada.

## 5. Enviar alterações futuras

Na pasta clonada, depois de editar:

```bash
git add .
git commit -m "Descreva sua alteração"
git pull origin main --no-rebase
git push origin main
```

Se houver conflitos no pull, resolva antes do push.
