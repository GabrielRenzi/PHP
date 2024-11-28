<?php
session_start();
include 'conexao.php';

function getPerguntas($conexao) {
    $query = "SELECT * FROM pergunta WHERE status = 'ativa' ORDER BY pergunta_id";
    $result = pg_query($conexao, $query);
    return pg_fetch_all($result);
}

$perguntas = getPerguntas($conexao);
$index = isset($_GET['index']) ? (int)$_GET['index'] : 0;
$totalPerguntas = count($perguntas);

if ($index < 0) $index = 0;
if ($index >= $totalPerguntas) $index = $totalPerguntas - 1;

$perguntaAtual = $perguntas[$index];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pergunta_id = $perguntaAtual['pergunta_id'];
    $_SESSION['respostas'][$pergunta_id] = $_POST['respostas'][$pergunta_id];
    $_SESSION['feedbacks'][$pergunta_id] = $_POST['feedbacks'][$pergunta_id] ?? null;

    if ($index === $totalPerguntas - 1) {
        header("Location: processa_avaliacao.php");
        exit();
    } else {
        header("Location: avaliacao.php?index=" . ($index + 1));
        exit();
    }
}

function getColor($value) {
    $colors = [
        '#FF0000', '#FF3300', '#FF6600', '#FF9900', '#FFCC00',
        '#FFFF00', '#CCFF00', '#99FF33', '#66FF66', '#33FF99', '#00CC66'
    ];
    return $colors[$value];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Serviços</title>
    <link rel="stylesheet" href="estilos/avali.css">
</head>
<body>
    <div class="container">
        <h2>Avaliação de Serviços</h2>

        <div class="imagem-container">
            <img src="imagens/logo.png" alt="Imagem Avaliação" class="imagem-avaliacao">
        </div>

        <form action="avaliacao.php?index=<?php echo $index; ?>" method="post">
            <div class="pergunta-container">
                <p class="pergunta-texto"><?php echo ($index + 1) . '. ' . htmlspecialchars($perguntaAtual['texto_pergunta']); ?></p>
                <div class="escala-avaliacao" data-pergunta-id="<?php echo $perguntaAtual['pergunta_id']; ?>">
                    <span class="label-improvavel">Improvável</span>
                    <?php for ($i = 0; $i <= 10; $i++): ?>
                        <label class="escala-item" style="background-color: <?php echo getColor($i); ?>">
                            <input type="radio" name="respostas[<?php echo $perguntaAtual['pergunta_id']; ?>]" value="<?php echo $i; ?>" required>
                            <span class="escala-numero"><?php echo $i; ?></span>
                        </label>
                    <?php endfor; ?>
                    <span class="label-provavel">Muito Provável</span>
                </div>
            </div>

            <div class="feedback-container">
                <label for="feedback_<?php echo $perguntaAtual['pergunta_id']; ?>">Deixe um feedback (opcional):</label>
                <textarea id="feedback_<?php echo $perguntaAtual['pergunta_id']; ?>" name="feedbacks[<?php echo $perguntaAtual['pergunta_id']; ?>]" rows="3"></textarea>
            </div>

            <p class="mensagem-anonimato">Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</p>

            <div class="navigation-buttons">
                <?php if ($index > 0): ?>
                    <a href="avaliacao.php?index=<?php echo $index - 1; ?>" class="btn-voltar">Voltar</a>
                <?php endif; ?>

                <?php if ($index === $totalPerguntas - 1): ?>
                    <button type="submit" class="btn-enviar">Enviar Avaliação</button>
                <?php else: ?>
                    <button type="submit" class="btn-proxima">Próxima</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <script src="java/avaliacao.js"></script>
</body>
</html>