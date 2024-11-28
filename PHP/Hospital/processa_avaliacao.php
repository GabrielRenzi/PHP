<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['dispositivo_id'])) {
    die("Erro: Dispositivo não selecionado.");
}

$dispositivo_id = $_SESSION['dispositivo_id'];
$dataHoraAtual = date("Y-m-d H:i:s");

if (isset($_SESSION['respostas']) && is_array($_SESSION['respostas'])) {
    foreach ($_SESSION['respostas'] as $pergunta_id => $resposta) {
        $feedback_textual = $_SESSION['feedbacks'][$pergunta_id] ?? null;

        $query = "INSERT INTO avaliacao (pergunta_id, dispositivo_id, resposta, feedback_textual, data_hora_avaliacao) VALUES ($1, $2, $3, $4, $5)";
        $result = pg_query_params($conexao, $query, array($pergunta_id, $dispositivo_id, $resposta, $feedback_textual, $dataHoraAtual));

        if (!$result) {
            echo "Erro ao inserir avaliação para a pergunta ID $pergunta_id.";
            exit();
        }
    }

    unset($_SESSION['respostas'], $_SESSION['feedbacks']);
}

header("Location: sucesso.php");
exit();
?>
