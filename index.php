<?php

// Inclui o arquivo de conexão com o banco de dados, a classe Produto e o Repositório de Produtos
global $pdo;
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

// Cria uma instância do Repositório de Produtos, passando a conexão PDO como parâmetro
$produtosRepositorio = new ProdutoRepositorio($pdo);

// Obtém as opções para o café da manhã e para o almoço
$dadosCafe = $produtosRepositorio->opcoesCafe();
$dadosAlmoco = $produtosRepositorio->opcoesAlmoco();

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
    <!-- Links para fontes no Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cardápio</title>
</head>
<body>
<main>
    <!-- Seção do banner principal -->
    <section class="container-banner">
        <div class="container-texto-banner">
            <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
        </div>
    </section>
    <h2>Cardápio Digital</h2>
    <!-- Seção para opções de café da manhã -->
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Opções para o Café</h3>
            <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-cafe-manha-produtos">
            <!-- Loop para exibir cada produto de café da manhã -->
            <?php foreach ($dadosCafe as $cafe):?>
                <div class="container-produto">
                    <div class="container-foto">
                        <!-- Exibe a imagem do produto -->
                        <img src="<?= $cafe->getImagemDiretorio() ?>" alt="<?= $cafe->getDescricao()?>">
                    </div>
                    <p><?= $cafe->getNome()?></p>
                    <p><?= $cafe->getDescricao()?></p>
                    <p><?= $cafe->getPrecoFormatado() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <!-- Seção para opções de almoço -->
    <section class="container-almoco">
        <div class="container-almoco-titulo">
            <h3>Opções para o Almoço</h3>
            <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-almoco-produtos">
            <!-- Loop para exibir cada produto de almoço -->
            <?php foreach ($dadosAlmoco as $almoco):?>
                <div class="container-produto">
                    <div class="container-foto">
                        <!-- Exibe a imagem do produto -->
                        <img src="<?= $almoco->getImagemDiretorio()?>" alt="<?= $almoco->getDescricao()?>">
                    </div>
                    <p><?= $almoco->getNome()?></p>
                    <p><?= $almoco->getDescricao()?></p>
                    <p><?= $almoco->getPrecoFormatado() ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
</body>
</html>
