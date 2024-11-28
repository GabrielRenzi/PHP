<?php
session_start();
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="estilos/dash.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Dashboard do Sistema</h1>
        <p>Escolha uma das opções abaixo para navegar no sistema:</p>
        
        <div class="dashboard-buttons">
            <a href="configuracao.php" class="dashboard-button">Iniciar Avaliações</a>
            <a href="cadastro.php" class="dashboard-button">Cadastro de Dispositivos e Perguntas</a>
            <a href="visualizar_avaliacoes.php" class="dashboard-button">Visualizar Avaliações</a>
            <a href="relatorios_estatisticas.php" class="dashboard-button">Relatórios e Estatísticas</a>
        </div>
    </div>
</body>
</html>
