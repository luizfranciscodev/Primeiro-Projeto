<?php

// Cria uma nova instância do objeto PDO para se conectar ao banco de dados MySQL
$pdo = new PDO('mysql:host=localhost;dbname=serenatto', 'root', 'uphsuto123@KL');

// Parâmetros da conexão:
// 'mysql:host=localhost' - Tipo de banco de dados (MySQL) e o host onde o banco de dados está localizado.
// 'dbname=serenatto' - Nome do banco de dados que será utilizado.
// 'root' - Nome de usuário do banco de dados.
// 'uphsuto123@KL' - Senha do banco de dados.

// Lembre-se de que este código é uma conexão simples e direta, e geralmente não é recomendado usar senhas diretamente no código em ambientes de produção. Em ambientes de produção, é preferível utilizar variáveis de ambiente ou algum método mais seguro para armazenar credenciais.
