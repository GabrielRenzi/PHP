<?php
session_start();
include 'conexao.php';

$query = "SELECT 
            pergunta.texto_pergunta, 
            avaliacao.resposta, 
            avaliacao.feedback_textual, 
            avaliacao.data_hora_avaliacao
          FROM avaliacao
          INNER JOIN pergunta ON avaliacao.pergunta_id = pergunta.pergunta_id
          ORDER BY pergunta.texto_pergunta, avaliacao.data_hora_avaliacao DESC";

$result = pg_query($conexao, $query);

if (!$result) {
    echo "Erro ao buscar avaliações.";
    exit();
}

$avaliacoes = pg_fetch_all($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Avaliações</title>
    <link rel="stylesheet" href="estilos/visu.css">
</head>
<body>
    <div class="avaliacoes-container">
        <a href="dashboard.php" class="btn-voltar">Voltar para o Dashboard</a>
        <h2>Avaliações Respondidas</h2>
        <?php if ($avaliacoes): ?>
            <?php
            $currentQuestion = '';
            foreach ($avaliacoes as $avaliacao): 
                if ($currentQuestion !== $avaliacao['texto_pergunta']) {
                    if ($currentQuestion !== '') {
                        echo "</div>";
                    }
                    $currentQuestion = $avaliacao['texto_pergunta'];
                    echo "<div class='pergunta-group'>";
                    echo "<h3>" . htmlspecialchars($currentQuestion) . "</h3>";
                }
            ?>
                <div class="avaliacao-item">
                    <p><strong>Nota:</strong> <?php echo $avaliacao['resposta']; ?></p>
                    <p><strong>Feedback:</strong> <?php echo htmlspecialchars($avaliacao['feedback_textual']); ?></p>
                    <p><strong>Data e Hora:</strong> <?php echo $avaliacao['data_hora_avaliacao']; ?></p>
                </div>
            <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Nenhuma avaliação encontrada.</p>
        <?php endif; ?>
    </div>
</body>
</html>
