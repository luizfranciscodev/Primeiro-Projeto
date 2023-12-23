<?php
global $pdo;  // Declaração da variável $pdo como global

// Inclui o arquivo que cria a instância do PDO
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";

// Consulta SQL para selecionar produtos do tipo 'Café' ordenados por preço
$sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";

// Executa a consulta SQL e obtém os resultados
$statementCafe = $pdo->query($sql1);
$produtosCafe = $statementCafe->fetchAll(PDO::FETCH_ASSOC);

// Utiliza a função array_map para criar objetos da classe Produto para cada produto de café
$dadosCafe = array_map(function ($cafe) {
    // Cria uma nova instância da classe Produto para cada elemento do array
    return new Produto(
        $cafe['id'],         // Atribui o valor da chave 'id' do array $cafe à propriedade 'id' da instância
        $cafe['tipo'],       // Atribui o valor da chave 'tipo' do array $cafe à propriedade 'tipo' da instância
        $cafe['nome'],       // Atribui o valor da chave 'nome' do array $cafe à propriedade 'nome' da instância
        $cafe['descricao'],  // Atribui o valor da chave 'descricao' do array $cafe à propriedade 'descricao' da instância
        $cafe['imagem'],     // Atribui o valor da chave 'imagem' do array $cafe à propriedade 'imagem' da instância
        $cafe['preco']       // Atribui o valor da chave 'preco' do array $cafe à propriedade 'preco' da instância
    );
}, $produtosCafe);  // O array $produtosCafe contém informações sobre os produtos do tipo café


// Consulta SQL para selecionar produtos do tipo 'Almoço' ordenados por preço
$sql2 = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";

// Executa a consulta SQL e obtém os resultados
$statementAlmoco = $pdo->query($sql2);
$produtosAlmoco = $statementAlmoco->fetchAll(PDO::FETCH_ASSOC);

// Utiliza a função array_map para criar objetos da classe Produto para cada produto de almoço
$dadosAlmoco = array_map(function ($almoco) {
    // Cria uma nova instância da classe Produto para cada elemento do array
    return new Produto(
        $almoco['id'],         // Atribui o valor da chave 'id' do array $almoco à propriedade 'id' da instância
        $almoco['tipo'],       // Atribui o valor da chave 'tipo' do array $almoco à propriedade 'tipo' da instância
        $almoco['nome'],       // Atribui o valor da chave 'nome' do array $almoco à propriedade 'nome' da instância
        $almoco['descricao'],  // Atribui o valor da chave 'descricao' do array $almoco à propriedade 'descricao' da instância
        $almoco['imagem'],     // Atribui o valor da chave 'imagem' do array $almoco à propriedade 'imagem' da instância
        $almoco['preco']       // Atribui o valor da chave 'preco' do array $almoco à propriedade 'preco' da instância
    );
}, $produtosAlmoco);  // O array $produtosAlmoco contém informações sobre os produtos do tipo almoço
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
