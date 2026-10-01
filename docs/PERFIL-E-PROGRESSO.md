# Minha conta e progresso do questionário

## Minha conta

Após entrar, use Minha conta no menu ou o link da página inicial. Você pode editar nome e e-mail, confirmando a senha atual. O e-mail é normalizado e precisa ser único. O CPF não é alterado nesta tela.

Para trocar a senha, informe a senha atual e confirme uma nova senha com pelo menos oito caracteres. A senha nova deve ser diferente da atual. O servidor grava o hash e renova remember_token. A sessão atual é encerrada e você entra novamente. Isso não promete encerrar todas as outras sessões já abertas em outros dispositivos.

As rotas exigem autenticação e as alterações recebem proteção CSRF e limite de requisições. O usuário editado vem da sessão; IDs enviados no formulário são ignorados. Senhas não são guardadas em old input.

## Questionário

O contador e a barra mostram quantas perguntas estão preenchidas, inclusive respostas já carregadas. Eles não salvam automaticamente: o envio continua pelo botão Salvar respostas e concluir. O formulário também pode ser enviado sem JavaScript, com validação do servidor.

## Atualizar e verificar

Não há novas migrations nesta atualização. Na pasta do projeto:

```bash
git pull origin main
php artisan optimize:clear
php artisan test
php artisan serve
```

Os testes de perfil cobrem autenticação, isolamento entre usuários, senha atual, e-mail duplicado e troca de senha. PHP e Composer continuam indisponíveis no ambiente de preparação; esses testes ainda precisam ser executados. O JavaScript do contador foi verificado separadamente com campos vazios e preenchidos.
