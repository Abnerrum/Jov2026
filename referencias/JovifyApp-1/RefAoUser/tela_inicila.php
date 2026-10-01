<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styls.css"> <!-- Link para o arquivo CSS externo -->
    <script>
        // Função JavaScript para mostrar um alerta
        function showAlert(linkName) {
            alert("Você clicou em: " + linkName);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Barra lateral esquerda -->
        <div class="menu-lateral col-4">
            <h5>Menu</h5>
            <a href="#" onclick="showAlert('Perfil')">Perfil</a>
            <a href="#" onclick="showAlert('Comunidade')">Comunidade</a>
            <a href="#" onclick="showAlert('Chat')">Chat</a>
            <a href="#" onclick="showAlert('Conteúdos')">Conteúdos</a>
            <a href="#" onclick="showAlert('Avatar')">Avatar</a>
            <a href="#" onclick="showAlert('Sobre')">Sobre</a>
            <a href="#" onclick="showAlert('Suporte')">Suporte</a>
            <hr> <!-- Linha de separação -->
        </div>

        <!-- Área central -->
        <div class="conteudo-central col-8">
            <h2>"Sonhos se realizam"</h2>
            <p class="seta">→ Vamos criar seu Avatar?</p>
            <p>Olá Júnior! Precisa conversar, amigo?</p>
        </div>
        </div>
    </div>

    <!-- Rodapé -->
    <div class="rodape">
        <p>Sobre | Suporte</p>
        <nav>
            <a href="index.php">Voltar para a Página Inicial</a>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
