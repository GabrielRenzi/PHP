<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuario_administrativo WHERE login = $1 AND senha = crypt($2, senha)";
    $result = pg_query_params($conexao, $query, array($login, $senha));

    if (pg_num_rows($result) == 1) {
        $_SESSION['usuario'] = $login;
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "Usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo</title>
    <link rel="stylesheet" href="estilos/login.css">
</head>
<body>
    <div class="login-container">
    <img src="imagens/logo.png" alt="Logo" class="login-image">
        <h2>Login Administrativo</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="login">Usuário:</label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        
        <?php if (!empty($erro)) { echo "<p class='error-message'>$erro</p>"; } ?>
    </div>
</body>
</html>
