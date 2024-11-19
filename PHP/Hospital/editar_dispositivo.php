<?php
include 'conexao.php';

// Verificar se o ID foi passado e obter os dados do dispositivo
if (isset($_GET['id'])) {
    $dispositivo_id = $_GET['id'];
    $query = "SELECT * FROM dispositivo WHERE dispositivo_id = $1";
    $result = pg_query_params($conexao, $query, array($dispositivo_id));
    $dispositivo = pg_fetch_assoc($result);
}

// Atualizar o dispositivo no banco de dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_dispositivo = $_POST['nome_dispositivo'];
    $status = $_POST['status'];
    $query = "UPDATE dispositivo SET nome_dispositivo = $1, status = $2 WHERE dispositivo_id = $3";
    pg_query_params($conexao, $query, array($nome_dispositivo, $status, $dispositivo_id));
    header("Location: cadastro.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Dispositivo</title>
    <link rel="stylesheet" href="estilos/cad.css">
</head>
<body>
    <h2>Editar Dispositivo</h2>

    <form action="editar_dispositivo.php?id=<?php echo $dispositivo_id; ?>" method="post">
        <label for="nome_dispositivo">Nome do Dispositivo:</label>
        <input type="text" id="nome_dispositivo" name="nome_dispositivo" value="<?php echo $dispositivo['nome_dispositivo']; ?>" required>
        
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="ativo" <?php if ($dispositivo['status'] == 'ativo') echo 'selected'; ?>>Ativo</option>
            <option value="inativo" <?php if ($dispositivo['status'] == 'inativo') echo 'selected'; ?>>Inativo</option>
        </select>
        
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
