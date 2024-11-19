<?php
session_start();
include 'conexao.php';

// Função para obter dispositivos
function getDispositivos($conexao) {
    $query = "SELECT * FROM dispositivo WHERE status = 'ativo'";
    $result = pg_query($conexao, $query);
    return pg_fetch_all($result);
}

// Obtendo dispositivos ativos
$dispositivos = getDispositivos($conexao);

// Salvando o dispositivo selecionado na sessão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dispositivo_id'])) {
        $_SESSION['dispositivo_id'] = $_POST['dispositivo_id'];
        header("Location: avaliacao.php?index=0"); // Redireciona para a primeira pergunta
        exit();
    } else {
        echo "Erro: Nenhum dispositivo selecionado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração de Dispositivo</title>
    <link rel="stylesheet" href="estilos/config.css">
</head>
<body>
    <div class="configuracao-container">
        <a href="dashboard.php" class="btn-voltar">Voltar para o Dashboard</a>  
        <h2>Configuração de Dispositivo para Avaliações</h2>
        
        <form action="configuracao.php" method="post">
            <label for="dispositivo">Escolha o Dispositivo:</label>
            <select name="dispositivo_id" id="dispositivo" required>
                <?php if ($dispositivos): ?>
                    <?php foreach ($dispositivos as $dispositivo): ?>
                        <option value="<?php echo $dispositivo['dispositivo_id']; ?>">
                            <?php echo $dispositivo['nome_dispositivo']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option disabled>Nenhum dispositivo disponível</option>
                <?php endif; ?>
            </select>

            <button type="submit" class="btn-configurar">Configurar</button>
    </div>
    </form>
</body>
</html>
