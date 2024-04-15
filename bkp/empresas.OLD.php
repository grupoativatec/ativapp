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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <button class="logout-btn" onclick="location.href='logout.php';">Sair</button>
    <div class="container">
    <a href="sucesso.php" class="sair-link"> <!-- Adicione a classe sair-link para posicionar a imagem -->
    </div>
</body>
</html>