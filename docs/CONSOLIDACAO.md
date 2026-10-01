# Consolidação do Jovify

## Repositório principal

https://github.com/Abnerrum/Jov2026

Este é o repositório escolhido para continuar o projeto e receber melhorias. A aplicação principal está na raiz.

## Origem do código antigo

- Repositório: https://github.com/Abnerrum/JovifyApp-1
- Versão copiada: c9ae760db82dd0a1ca80ab96243559058598c43f
- Destino da cópia: referencias/JovifyApp-1/
- Arquivos preservados: 140.

Foram preservados todos os arquivos de código e referência desse commit, incluindo a aplicação antiga da raiz, sua cópia em Jovify/, RefAoUser/ e Home.zip. Os hashes dos arquivos copiados foram conferidos. Os arquivos locais do Visual Studio (.vs/) não fazem parte do código e não foram importados. JovifyApp era um gitlink para o commit ed4d5eedb9dae1bca9382e4d0e6cea7779ab176a, sem conteúdo de arquivos nesse repositório; ele não foi convertido em uma pasta de aplicação.

## Correções mantidas na aplicação principal

- Chave primária usuarios.id e autenticação pelo model Usuario.
- Cadastro redirecionando para login com mensagem de sucesso.
- Erros de login apresentados no formulário.
- Seeder da conta demo usando Usuario.
- TokenMiddleware com Request importado e consulta ao model correto.
- Questionário POST autenticado, validação de oito perguntas e persistência no banco.
- Conclusão e revisão das respostas do próprio usuário.
- Logout e regeneração da sessão.
- Configuração local de SQLite, sessões e cache em arquivos.

As telas antigas que exibem um perfil fixo, como Guardião, permanecem apenas nas referências. A aplicação principal confirma as respostas sem atribuir um perfil: ainda não existe uma regra definida de classificação.

## Como executar

Siga docs/PASSO-A-PASSO.md na raiz. Não execute os comandos dentro de referencias/. A configuração e as migrations documentadas são para uma instalação nova; importar um banco antigo exige conferir o nome da chave primária antes, pois o código antigo usa nomes incompatíveis com usuarios.id.

## Verificação realizada

Comparação das árvores dos dois repositórios, conferência dos hashes dos arquivos preservados e verificação de que nenhum arquivo da aplicação atual foi substituído por sua versão antiga. PHP e Composer estão indisponíveis no ambiente de preparação; os testes de execução permanecem pendentes.
