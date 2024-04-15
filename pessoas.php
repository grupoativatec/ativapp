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
<html lang="pt-BR"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AtivAPP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/styleempresas.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="sucesso.php" class="sair-link"> <!-- Adicione a classe sair-link para posicionar a imagem -->
                <img src="img/voltar.png" alt="voltar" width="40" height="40";>
            </a>
                <span class="span-voltar";>| MENU PRINCIPAL</span> <!-- Adicione o texto ao lado da imagem -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <img class="logout-img" src="img/sair.png" onclick="location.href='logout.php';">
                </li>
            </ul>
        </div>
    </nav>
	<div id="flash-messages">
        
            
        
    </div>
    <div class="container mt-4">
        
    <h1>PESSOAS</h1>
    <h2><a href="cadastro_cliente.html" class="btn btn-primary">Adicionar</a></h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Documento</th>
                <th>Cidade/UF</th>
                <th>Email</th>
                <th>Contato</th>
                <th>Data de Aniversário</th>
                <th>Ações</th>
            </tr>
        </thead>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body></html>