<?php

$host = "localhost";    
$port = "5432";        
$dbname = "hospital"; 
$user = "postgres";       
$password = "1234"; 

$conexao = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . pg_last_error());
}
?>
