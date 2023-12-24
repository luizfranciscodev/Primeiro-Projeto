<?php
// Globaliza a variável $pdo para ser utilizada neste escopo
global $pdo;

// Inclui os arquivos necessários
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

// Cria uma instância do ProdutoRepositorio passando a instância do PDO como parâmetro
$produtosRepositorio = new ProdutoRepositorio($pdo);

// Chama o método opcoesCafe para obter as opções de café do banco de dados
$dadosCafe = $produtosRepositorio->opcoesCafe();

// Chama um método fictício opcoesAlmoco para obter as opções de almoço (adicione este método se não existir)
$dadosAlmoco = $produtosRepositorio->opcoesAlmoco();

// Agora, $dadosCafe contém um array de objetos Produto representando as opções de café
// E $dadosAlmoco contém um array de objetos Produto representando as opções de almoço (se o método existir)

// Você pode usar esses dados para exibi-los no seu HTML ou realizar outras operações necessárias
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cardápio</title></head>
<body>
<main>
    <!-- Seção do banner -->

    <!-- Título principal -->
    <h2>Cardápio Digital</h2>

    <!-- Seção de produtos para o café da manhã -->
    <section class="container-cafe-manha">
        <!-- Título e ornamentação -->
        <div class="container-cafe-manha-titulo">
            <h3>Opções para o Café</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>

        <!-- Container para os produtos de café -->
        <div class="container-cafe-manha-produtos">
            <?php foreach ($dadosCafe as $cafe): ?>
                <!-- Container individual para cada produto de café -->
                <div class="container-produto">
                    <!-- Imagem do produto -->
                    <div class="container-foto">
                        <img src="<?= "img/" . $cafe->getImagem() ?>" alt="<?= $cafe->getDescricao() ?>">
                    </div>

                    <!-- Nome, descrição e preço do produto -->
                    <p><?= $cafe->getNome() ?></p>
                    <p><?= $cafe->getDescricao() ?></p>
                    <p><?= $cafe->getPrecoFormatado() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Seção de produtos para o almoço -->
    <section class="container-almoco">
        <!-- Título e ornamentação -->
        <div class="container-almoco-titulo">
            <h3>Opções para o Almoço</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>

        <!-- Container para os produtos de almoço -->
        <div class="container-almoco-produtos">
            <?php foreach ($dadosAlmoco as $almoco): ?>
                <!-- Container individual para cada produto de almoço -->
                <div class="container-produto">
                    <!-- Imagem do produto -->
                    <div class="container-foto">
                        <img src="<?= "img/" . $almoco->getImagem() ?>" alt="<?= $almoco->getDescricao() ?>">
                    </div>

                    <!-- Nome, descrição e preço do produto -->
                    <p><?= $almoco->getNome() ?></p>
                    <p><?= $almoco->getDescricao() ?></p>
                    <p><?= $almoco->getPrecoFormatado() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
</body>
</html>
