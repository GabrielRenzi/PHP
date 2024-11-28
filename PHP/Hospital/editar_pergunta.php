<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $pergunta_id = $_GET['id'];
    $query = "SELECT * FROM pergunta WHERE pergunta_id = $1";
    $result = pg_query_params($conexao, $query, array($pergunta_id));
    $pergunta = pg_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto_pergunta = $_POST['texto_pergunta'];
    $status = $_POST['status'];
    $query = "UPDATE pergunta SET texto_pergunta = $1, status = $2 WHERE pergunta_id = $3";
    pg_query_params($conexao, $query, array($texto_pergunta, $status, $pergunta_id));
    header("Location: cadastro.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pergunta</title>
    <link rel="stylesheet" href="estilos/cad.css">
</head>
<body>
    <h2>Editar Pergunta</h2>

    <form action="editar_pergunta.php?id=<?php echo $pergunta_id; ?>" method="post">
        <label for="texto_pergunta">Texto da Pergunta:</label>
        <input type="text" id="texto_pergunta" name="texto_pergunta" value="<?php echo $pergunta['texto_pergunta']; ?>" required>
        
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="ativa" <?php if ($pergunta['status'] == 'ativa') echo 'selected'; ?>>Ativa</option>
            <option value="inativa" <?php if ($pergunta['status'] == 'inativa') echo 'selected'; ?>>Inativa</option>
        </select>
        
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
