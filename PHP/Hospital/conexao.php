<?php
// Configurações de conexão com o banco de dados
$host = "localhost";     // Endereço do servidor
$port = "5432";          // Porta do PostgreSQL (padrão é 5432)
$dbname = "hospital"; // Substitua pelo nome do seu banco de dados
$user = "postgres";       // Substitua pelo nome do usuário do banco de dados
$password = "1234";     // Substitua pela senha do usuário

// Conexão com o banco de dados
$conexao = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . pg_last_error());
}
?>
