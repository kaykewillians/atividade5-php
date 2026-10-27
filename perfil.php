
<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION["cor_fundo"])) {
    $_SESSION["cor_fundo"] = "#e9eef5";
}

$coresPermitidas = [
    "#e9eef5",
    "#d9f3e4",
    "#fce4ec",
    "#fff3cd",
    "#e3e0ff",
    "#ffffff",
    "#222222"
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cor = $_POST["cor_fundo"] ?? "";

    if (in_array($cor, $coresPermitidas, true)) {
        $_SESSION["cor_fundo"] = $cor;
    }

    header("Location: perfil.php");
    exit;
}

$corFundo = $_SESSION["cor_fundo"];
$texto = $corFundo === "#222222" ? "#ffffff" : "#222222";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: <?= htmlspecialchars($corFundo) ?>;
            color: <?= $texto ?>;
            margin: 0;
            padding: 30px;
        }

        .perfil {
            max-width: 650px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.92);
            color: #222;
            box-shadow: 0 5px 20px #0002;
        }

        h1 {
            color: #245bc5;
        }

        select, button, .sair {
            padding: 12px;
            margin-top: 12px;
            border-radius: 7px;
            border: 1px solid #ccc;
        }

        button {
            background: #245bc5;
            color: white;
            cursor: pointer;
            border: none;
        }

        .sair {
            display: inline-block;
            background: #c62828;
            color: white;
            text-decoration: none;
            border: none;
        }
    </style>
</head>

<body>
    <main class="perfil">
        <h1>Meu Perfil</h1>

        <p>
            Bem-vindo(a),
            <strong><?= htmlspecialchars($_SESSION["usuario_nome"]) ?></strong>!
        </p>

        <p>
            <strong>E-mail:</strong>
            <?= htmlspecialchars($_SESSION["usuario_email"]) ?>
        </p>

        <hr>

        <h2>Personalizar perfil</h2>
        <p>Escolha uma cor para o fundo da página:</p>

        <form method="POST">
            <label for="cor_fundo">Cor de fundo:</label>

            <select name="cor_fundo" id="cor_fundo">
                <?php foreach ($coresPermitidas as $cor): ?>
                    <option
                        value="<?= $cor ?>"
                        <?= $cor === $corFundo ? "selected" : "" ?>
                    >
                        <?= $cor ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Salvar cor</button>
        </form>

        <hr>

        <a class="sair" href="logout.php">Sair da conta</a>
    </main>
</body>
</html>
