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

// Função para conexão com o banco de dados e recuperação de empresas
function getEmpresasFromDatabase() {
    // Configurações de conexão ao banco de dados
    $host = "localhost";
    $user = "root"; // Substitua 'seu_usuario' pelo nome de usuário do seu banco de dados
    $senha = ""; // Substitua 'sua_senha' pela senha do seu banco de dados
    $banco = "login"; // Substitua 'seu_banco' pelo nome do seu banco de dados

    // Conexão ao banco de dados
    $conn = mysqli_connect($host, $user, $senha, $banco);

    // Verifique se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Consulta ao banco de dados
    $sql = "SELECT * FROM empresas";
    $result = mysqli_query($conn, $sql);

    // Fechar conexão com o banco de dados
    mysqli_close($conn);

    return $result;
}

// Chama a função para recuperar as empresas do banco de dados
$empresas = getEmpresasFromDatabase();
?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo Ativa</title>
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
    <h1>EMPRESAS</h1>
    <h2><a href="cadastro_cliente.php" class="btn btn-primary">Adicionar</a></h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Endereço</th>
            <th>Cidade/UF</th>
            <th>Data de Aniversário</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Iterar sobre os resultados da consulta e preencher a tabela
        while ($row = mysqli_fetch_assoc($empresas)) {
            echo "<tr>";
            echo "<td>{$row['id_empresa']}</td>";
            echo "<td>{$row['nome_empresa']}</td>";
            echo "<td>{$row['cnpj_empresa']}</td>";
            echo "<td>{$row['endereco_empresa']}</td>";
            echo "<td>{$row['cidade_empresa']}</td>";
            echo "<td>{$row['aniversario_empresa']}</td>";
            // Adicione aqui as colunas para as ações, se necessário
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>