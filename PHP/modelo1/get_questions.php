<?php
include 'db.php';

try {
    $stmt = $pdo->prepare("SELECT id, question_text FROM questions ORDER BY question_order ASC");
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Verifique se há perguntas retornadas
    if (empty($questions)) {
        echo json_encode(['error' => 'Nenhuma pergunta encontrada.']);
        exit;
    }
    
    echo json_encode($questions);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar perguntas: ' . $e->getMessage()]);
}
?>
