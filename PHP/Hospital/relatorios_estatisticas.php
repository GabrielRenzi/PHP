<?php
session_start();
include 'conexao.php';

$query = "SELECT 
            dispositivo.nome_dispositivo, 
            AVG(avaliacao.resposta) AS media_notas
          FROM avaliacao
          INNER JOIN dispositivo ON avaliacao.dispositivo_id = dispositivo.dispositivo_id
          GROUP BY dispositivo.nome_dispositivo
          ORDER BY dispositivo.nome_dispositivo";

$result = pg_query($conexao, $query);

if (!$result) {
    echo "Erro ao buscar os dados.";
    exit();
}

$estatisticas = pg_fetch_all($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios e Estatísticas</title>
    <link rel="stylesheet" href="estilos/rela.css">
</head>
<body>
    <div class="estatisticas-container">
        <a href="dashboard.php" class="btn-voltar">Voltar para o Dashboard</a>

        <h2>Média de Notas por Dispositivo</h2>
        <?php if ($estatisticas): ?>
            <table>
                <thead>
                    <tr>
                        <th>Dispositivo</th>
                        <th>Média de Notas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estatisticas as $estatistica): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($estatistica['nome_dispositivo']); ?></td>
                            <td><?php echo number_format($estatistica['media_notas'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhuma estatística encontrada.</p>
        <?php endif; ?>
    </div>
</body>
</html>
