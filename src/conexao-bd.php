<?php
// conexao-bd.php

// Configurações do banco de dados
$dsn = "mysql:host=localhost;dbname=serenatto";  // DSN (Data Source Name) para MySQL
$usuario = "root";                              // Nome de usuário do banco de dados
$senha = "uphsuto123@KL";                       // Senha do banco de dados

try {
    // Cria uma nova instância do PDO (PHP Data Objects)
    $pdo = new PDO($dsn, $usuario, $senha);

    // Configura o PDO para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Captura erros de conexão e exibe uma mensagem de erro
    echo 'Erro de conexão: ' . $e->getMessage();
}

