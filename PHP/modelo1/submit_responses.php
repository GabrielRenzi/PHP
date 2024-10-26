<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$responses = $data['responses'];
$feedback = isset($data['feedback']) ? $data['feedback'] : null;

try {
    $pdo->beginTransaction();
    foreach ($responses as $response) {
        // Inserindo a resposta e a observação
        $stmt = $pdo->prepare("INSERT INTO responses (question_id, score, feedback) VALUES (?, ?, ?)");
        $feedback = isset($response['feedback']) ? $response['feedback'] : null; // Captura o campo de feedback
        $stmt->execute([$response['question_id'], $response['score'], $feedback]);
    }
    
    if ($feedback) {
        // Armazenar feedback adicional, se existir
        $stmt = $pdo->prepare("INSERT INTO responses (question_id, feedback) VALUES (NULL, ?)");
        $stmt->execute([$feedback]);
    }

    $pdo->commit();
    echo json_encode(['message' => 'Avaliação enviada com sucesso.']);
} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode(['error' => 'Erro ao enviar avaliação: ' . $e->getMessage()]);
}
?>
