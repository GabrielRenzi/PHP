<?php
session_start();
include 'conexao.php';

function getDispositivos($conexao) {
    $query = "SELECT * FROM dispositivo";
    $result = pg_query($conexao, $query);
    return pg_fetch_all($result);
}

function getPerguntas($conexao) {
    $query = "SELECT * FROM pergunta";
    $result = pg_query($conexao, $query);
    return pg_fetch_all($result);
}

if (isset($_POST['excluir_dispositivo'])) {
    $dispositivo_id = $_POST['dispositivo_id'];
    $query = "DELETE FROM dispositivo WHERE dispositivo_id = $1";
    pg_query_params($conexao, $query, array($dispositivo_id));
    header("Location: cadastro.php");
    exit();
}

if (isset($_POST['excluir_pergunta'])) {
    $pergunta_id = $_POST['pergunta_id'];
    $query = "DELETE FROM pergunta WHERE pergunta_id = $1";
    pg_query_params($conexao, $query, array($pergunta_id));
    header("Location: cadastro.php");
    exit();
}

if (isset($_POST['cadastrar_dispositivo'])) {
    $nome_dispositivo = $_POST['nome_dispositivo'];
    $status = $_POST['status'];
    $query = "INSERT INTO dispositivo (nome_dispositivo, status) VALUES ($1, $2)";
    pg_query_params($conexao, $query, array($nome_dispositivo, $status));
    header("Location: cadastro.php");
    exit();
}

if (isset($_POST['cadastrar_pergunta'])) {
    $texto_pergunta = $_POST['texto_pergunta'];
    $status = $_POST['status'];
    $query = "INSERT INTO pergunta (texto_pergunta, status) VALUES ($1, $2)";
    pg_query_params($conexao, $query, array($texto_pergunta, $status));
    header("Location: cadastro.php");
    exit();
}

$dispositivos = getDispositivos($conexao);
$perguntas = getPerguntas($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Dispositivos e Perguntas</title>
    <link rel="stylesheet" href="estilos/cad.css">
</head>
<body>
    <h2>Dispositivos Cadastrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($dispositivos): ?>
                <?php foreach ($dispositivos as $dispositivo): ?>
                    <tr>
                        <td><?php echo $dispositivo['dispositivo_id']; ?></td>
                        <td><?php echo $dispositivo['nome_dispositivo']; ?></td>
                        <td><?php echo $dispositivo['status']; ?></td>
                        <td>
                            <a href="editar_dispositivo.php?id=<?php echo $dispositivo['dispositivo_id']; ?>" class="edit-button">Alterar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Nenhum dispositivo encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Perguntas Cadastradas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pergunta</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($perguntas): ?>
                <?php foreach ($perguntas as $pergunta): ?>
                    <tr>
                        <td><?php echo $pergunta['pergunta_id']; ?></td>
                        <td><?php echo $pergunta['texto_pergunta']; ?></td>
                        <td><?php echo $pergunta['status']; ?></td>
                        <td>
                            <a href="editar_pergunta.php?id=<?php echo $pergunta['pergunta_id']; ?>" class="edit-button">Alterar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Nenhuma pergunta encontrada.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Cadastrar Novo Dispositivo</h2>
    <form action="cadastro.php" method="post">
        <input type="hidden" name="cadastrar_dispositivo" value="1">
        <label for="nome_dispositivo">Nome do Dispositivo:</label>
        <input type="text" id="nome_dispositivo" name="nome_dispositivo" required>
        
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="ativo">Ativo</option>
            <option value="inativo">Inativo</option>
        </select>
        
        <button type="submit">Cadastrar Dispositivo</button>
    </form>

    <h2>Cadastrar Nova Pergunta</h2>
    <form action="cadastro.php" method="post">
        <input type="hidden" name="cadastrar_pergunta" value="1">
        <label for="texto_pergunta">Texto da Pergunta:</label>
        <input type="text" id="texto_pergunta" name="texto_pergunta" required>
        
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="ativa">Ativa</option>
            <option value="inativa">Inativa</option>
        </select>
        
        <button type="submit">Cadastrar Pergunta</button>

        <div class="avancar-container">
            <a href="dashboard.php" class="btn-avancar">Voltar</a>
        </div>
    </form>
</body>
</html>
