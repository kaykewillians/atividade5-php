
<?php
require_once "conexao.php";

$nome = "Kayke";
$email = "kaykewilliansv@gmail.com";
$senha = password_hash("123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha)
        VALUES (?, ?, ?)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $senha]);

    echo "Usuário criado com sucesso!";
} catch (PDOException $e) {
    echo "Não foi possível criar o usuário. Verifique se o e-mail já existe.";
}
?>
