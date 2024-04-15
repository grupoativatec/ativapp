<?php
session_start();
require_once 'conexao.php';

// Definindo inicialmente $email_value como uma string vazia
$email_value = '';

// Verifica se o formulário foi submetido e se os campos estão definidos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['senha'])) {
    // Pegue os valores do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar as credenciais
    $sql = "SELECT nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conn, $sql);

    // Verifique se há uma linha correspondente
    if (mysqli_num_rows($result) == 1) {
        // Se as credenciais estiverem corretas, redirecione para a página de sucesso
        $row = mysqli_fetch_assoc($result);
        $_SESSION['nome'] = $row['nome'];
        header('Location: sucesso.php');
        exit();
    } else {
        // Se as credenciais estiverem incorretas, exiba uma mensagem de erro
        $erro = "Email ou senha incorretos.";
        // Armazene o valor do email na variável $email_value para mantê-lo preenchido
        $email_value = $email;
    }
} elseif (isset($_SESSION['login_error']['email'])) {
    // Se o formulário não foi submetido e se existe um valor de email armazenado na sessão
    // Defina $email_value como o valor armazenado na sessão
    $email_value = $_SESSION['login_error']['email'];
    // Limpe a variável de sessão após usar seu valor
    unset($_SESSION['login_error']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <!--CSS-->
    <link rel="stylesheet" href="css/stylelogin.css">
    <link rel="stylesheet" href="css/media.css">

    <!--JS & jQuery-->
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <div id="container">
        <div class="banner">
            <img src="img/login.png">
        </div>

        <div class="box-login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h1>
                LOGIN
            </h1>

            <div class="box">
                <input type="email" name="email" id="username" placeholder="e-mail" required value="<?php echo htmlspecialchars($email_value); ?>">
                <input type="password" name="senha" id="senha" placeholder="senha" required> 
                <button type="submit">Entrar</button>
                <?php if (isset($erro)) { ?>
                <p class="error-message"><?php echo $erro; ?></p>
            <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
