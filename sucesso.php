<?php
session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['nome'])) {
    header('Location: index.php'); // Redireciona para a página de login se o usuário não estiver logado
    exit();
}

// Verifica se o botão de logout foi clicado
if (isset($_GET['logout'])) {
    // Destroi a sessão
    session_destroy();
    // Redireciona para a página de login
    header('Location: index.php?logout=true');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Principal</title>
    <link rel="stylesheet" href="css/stylesucess.css">
    <link rel="stylesheet" href="css/media.css">
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Seleciona todas as divs com a classe 'option'
        var options = document.querySelectorAll('.option');

        // Adiciona um ouvinte de evento 'click' a cada uma
        options.forEach(function(option) {
            option.addEventListener('click', function() {
                // Encontra o primeiro link dentro da div e redireciona para o seu href
                window.location.href = option.querySelector('a').href;
            });
        });
    });
    </script>
</head>
<body>
    <img class="logout-img" src="img/sair.png" onclick="location.href='logout.php';">>
    <div class="container">
        <div class="options">
            <a href="sucesso.php" class="sair-link"> <!-- Adicione a classe sair-link para posicionar a imagem -->
                <img src="img/voltar.png" alt="voltar" width="40" height="40" style="margin-left: 12px";>
                <span class="span-voltar" style="margin-right: 55px";> | MENU PRINCIPAL</span> <!-- Adicione o texto ao lado da imagem -->
            </a>
            <div class="option">
                <a href="empresas.php">
                    <img src="img/empresas.png">
                    <span class="text-over-image">Empresas</span>
                </a>
            </div>
            <div class="option">
                <a href="pessoas.php">
                    <img src="img/pessoas.png" alt="Tela 2">
                    <span class="text-over-image">Pessoas</span>
                </a>
            </div>
            <div class="option">
                <a href="relatorios.php">
                    <img src="img/relatorios.png" alt="Tela 3">
                    <span class="text-over-image">Relatórios</span>
                </a>
            </div>
            <div class="option">
                <a href="ajustes.php">
                    <img src="img/ajustes.png" alt="Tela 4">
                    <span class="text-over-image">Ajustes</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>