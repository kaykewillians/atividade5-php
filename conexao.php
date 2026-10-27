<?php
$host = "localhost";
$banco = "atividade5_php";
$usuario = "root";
$senha = "Senai@118";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    echo "Conexão realizada com sucesso!";
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}
?>