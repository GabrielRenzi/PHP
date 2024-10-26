<?php
session_start();
require_once 'conexao.php';

function carregarPerguntaAtual($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM perguntas ORDER BY id ASC");
        $perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['totalPerguntas'] = count($perguntas);

        if ($_SESSION['progresso'] < $_SESSION['totalPerguntas']) {
            $perguntaAtual = $perguntas[$_SESSION['progresso']];
            $_SESSION['pergunta_atual'] = $perguntaAtual['pergunta'];
            $_SESSION['pergunta_id'] = $perguntaAtual['id'];
        } else {
            session_destroy();
            header('Location: obrigado.php');
            exit();
        }
    } catch (PDOException $e) {
        die("Erro ao buscar perguntas: " . $e->getMessage());
    }
}

if (!isset($_SESSION['progresso'])) {
    $_SESSION['progresso'] = 0;
    carregarPerguntaAtual($pdo);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $avaliacao = $_POST['avaliacao'];
    $reclamacaoSugestao = $_POST['reclamacaoSugestao'] ?? null;
    $perguntaId = $_SESSION['pergunta_id'];

    try {
        $stmt = $pdo->prepare("INSERT INTO respostas (pergunta_id, nota, comentario) VALUES (:pergunta_id, :nota, :comentario)");
        $stmt->execute([
            ':pergunta_id' => $perguntaId,
            ':nota' => $avaliacao,
            ':comentario' => $reclamacaoSugestao
        ]);
    } catch (PDOException $e) {
        die("Erro ao salvar a resposta: " . $e->getMessage());
    }

    $_SESSION['progresso']++;
    carregarPerguntaAtual($pdo);
}

header('Location: index.php');
exit();
