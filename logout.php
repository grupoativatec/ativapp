<?php
session_start();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header('Location: index.php?logout=true');
exit();
?>
