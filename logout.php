
<?php
session_start();

// Limpa os dados da sessão.
$_SESSION = [];

// Destrói a sessão atual.
session_destroy();

// Retorna à página de login.
header("Location: login.php");
exit;
?>
