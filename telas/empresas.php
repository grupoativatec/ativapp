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
    <link rel="stylesheet" href="css/media.css">
</head>
<body>
    <button class="logout-btn" onclick="location.href='logout.php';">Sair</button>
    <div class="container">
        <div class="options">
        <div class="option"><a href="empresas.php"><img src="img/empresas.png" alt="Tela 1"></a></div>
<div class="option"><a href="pessoas.php"><img src="img/pessoas.png" alt="Tela 2"></a></div>
<div class="option"><a href="relatorios.php"><img src="img/relatorios.png" alt="Tela 3"></a></div>
<div class="option"><a href="ajustes.php"><img src="img/ajustes.png" alt="Tela 4"></a></div>
        </div>
    </div>

</body>
</html>
