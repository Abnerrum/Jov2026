# Melhorias de navegação e cadastro

- Página /inicio protegida por login, com nome, e-mail, data da conta e status real do questionário.
- Login direciona para a página inicial ou para a página protegida que o visitante tentou abrir.
- Login e cadastro com layout compartilhado, CSS local, rótulos, autocomplete, foco visível e visual responsivo.
- Cadastro aceita CPF com ou sem pontuação e armazena 11 dígitos. Essa regra confere formato e duplicidade; não calcula os dígitos verificadores nem verifica titularidade.
- E-mail é normalizado para minúsculas e sem espaços nas extremidades no cadastro e login.
- Novas senhas precisam de pelo menos oito caracteres; contas já existentes continuam podendo entrar com suas senhas anteriores.
- Senhas e confirmação não são colocadas em old input quando o cadastro falha.
- Login limitado a seis requisições por minuto pelo middleware throttle. Após exceder, o servidor retorna HTTP 429; aguarde um minuto para tentar novamente.
- Links de retorno à página inicial nas telas do questionário.
- Removidos links de recuperação de senha e termos que apontavam apenas para #. Essas funcionalidades ainda não estão implementadas.

Não há mudança no banco. Após atualizar, execute php artisan optimize:clear. Para verificar, execute php artisan test. Os testes novos cobrem a página inicial, normalização do cadastro, rejeição de senha curta, proteção de dados de senha na sessão e limitação de login. PHP/Composer não estão disponíveis no ambiente de preparação: execução dos testes pendente.
