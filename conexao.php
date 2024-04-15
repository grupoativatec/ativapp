<?php
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
?>
