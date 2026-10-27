
<?php
session_start();
require_once "conexao.php";

if (isset($_SESSION["usuario_id"])) {
    header("Location: perfil.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    $sql = "SELECT id, nome, email, senha
            FROM usuarios
            WHERE email = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario["senha"])) {
        session_regenerate_id(true);

        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_nome"] = $usuario["nome"];
        $_SESSION["usuario_email"] = $usuario["email"];

        header("Location: perfil.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perfil de Usuário</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #e9eef5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 35px;
            border-radius: 15px;
            width: 350px;
            max-width: 92%;
            box-shadow: 0 5px 20px #0002;
        }

        h1 {
            text-align: center;
            color: #234b87;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 7px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 22px;
            background: #245bc5;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        .erro {
            color: #c62828;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Fazer login</h1>
        <p>Acesse seu perfil de usuário.</p>

        <?php if ($erro !== ""): ?>
            <p class="erro">
                <?= htmlspecialchars($erro) ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email"
                   required autocomplete="username">

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha"
                   required autocomplete="current-password">

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
