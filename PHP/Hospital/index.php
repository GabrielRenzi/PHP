<?php
session_start(); 

if (!isset($_SESSION['pergunta_atual'])) {
    header('Location: processa_resposta.php'); 
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Avaliação</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Formulário de Avaliação</h1>
    <div class="pergunta">
        <?php echo htmlspecialchars($_SESSION['pergunta_atual']); ?>
    </div>

    <form action="processa_resposta.php" method="POST">
        <div class="container">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <label>
                    <input type="radio" name="avaliacao" value="<?php echo $i; ?>" required>
                    <div class="bloco bloco-<?php echo $i; ?>"><?php echo $i; ?></div>
                </label>
            <?php endfor; ?>
        </div>

        <div class="textarea-container">
            <label for="reclamacaoSugestao"><strong>Deixe seu feedback:</strong></label><br>
            <textarea name="reclamacaoSugestao" id="reclamacaoSugestao" placeholder="Escreva aqui..."></textarea><br>

            <div class="anonimato-msg">
                Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.
            </div>

            <button type="submit">Próxima Pergunta</button>
        </div>
    </form>
</body>
</html>
