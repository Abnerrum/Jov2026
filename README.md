# Jov2026


## Jovify — repositório principal

O desenvolvimento e as próximas atualizações do Jovify estão centralizados neste repositório.

### Aplicação atual

Use a **raiz do projeto**, onde estão `artisan` e `composer.json`.

- Laravel 11 / PHP 8.2 ou superior.
- Cadastro e login por sessão com `App\\Models\\Usuario` e a tabela `usuarios`.
- Questionário com oito perguntas, validação e respostas salvas por usuário.
- Tela de conclusão e revisão das respostas; um novo envio atualiza o registro existente.
- Logout, renovação da sessão no login e configuração local com SQLite.

Leia o [guia passo a passo em português](docs/PASSO-A-PASSO.md).

### Baixar o projeto

```bash
git clone https://github.com/Abnerrum/Jov2026.git
cd Jov2026
```

Se você já clonou este repositório, salve suas alterações locais e execute `git pull origin main` nessa pasta.

### Código antigo preservado

Os arquivos antigos de [JovifyApp-1](https://github.com/Abnerrum/JovifyApp-1) estão em [referencias/JovifyApp-1](referencias/JovifyApp-1). Essa cópia preserva o código Laravel anterior, as telas de referência e `Home.zip`. Consulte [a explicação da consolidação](docs/CONSOLIDACAO.md).

A aplicação atualizada está na raiz. As cópias dentro de `referencias/` servem para consulta e não fazem parte do fluxo ativo.

### Testes

Execute `php artisan test` após instalar as dependências e gerar a chave. Há testes de autenticação, validação, gravação, atualização e isolamento de respostas entre usuários. Eles ainda não foram executados no ambiente de preparação, que não possui PHP/Composer.
