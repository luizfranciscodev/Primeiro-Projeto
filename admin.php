<?php
// Inclui o arquivo de conexão com o banco de dados, a classe Produto e o Repositório de Produtos
global $pdo;
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

// Cria uma instância do Repositório de Produtos, passando a conexão PDO como parâmetro
$produtoRepositorio = new ProdutoRepositorio($pdo);

// Obtém todos os produtos do banco de dados
$produtos = $produtoRepositorio->buscarTodos();
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Links para os estilos CSS -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <!-- Links para fontes no Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Admin</title>
</head>
<body>
<main>
    <!-- Seção do banner da administração -->
    <section class="container-admin-banner">
        <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
        <h1>Administração Serenatto</h1>
        <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <h2>Lista de Produtos</h2>

    <!-- Seção da tabela de produtos -->
    <section class="container-table">
        <table>
            <thead>
            <tr>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th colspan="2">Ação</th>
            </tr>
            </thead>
            <tbody>
            <!-- Loop através dos produtos para exibir na tabela -->
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto->getNome() ?></td>
                    <td><?= $produto->getTipo() ?></td>
                    <td><?= $produto->getDescricao() ?></td>
                    <td><?= $produto->getPrecoFormatado() ?></td>
                    <td><a class="botao-editar" href="/editar-produto.php?id=<?= $produto->getId() ?>">Editar</a></td>
                    <td>
                        <!-- Formulário para excluir um produto -->
                        <form action="/excluir-produto.php" method="post">
                            <input type="hidden" name="id" value="<?= $produto->getId() ?>">
                            <input type="submit" class="botao-excluir" value="Excluir">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Links para cadastrar um novo produto e gerar um relatório em PDF -->
        <a class="botao-cadastrar" href="/cadastrar-produto.php">Cadastrar produto</a>
        <form action="/gerador-pdf.php" method="post">
            <input type="submit" class="botao-cadastrar" value="Baixar Relatório"/>
        </form>
    </section>
</main>
</body>
</html>
