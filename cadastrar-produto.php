<?php

// Inclui o arquivo de conexão com o banco de dados, a classe Produto e o Repositório de Produtos
global $pdo;
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

// Verifica se o formulário foi enviado
if (isset($_POST['cadastro'])){
    // Cria uma instância da classe Produto com os dados do formulário
    $produto = new Produto(null,
        $_POST['tipo'],
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco']
    );

    // Verifica se uma imagem foi enviada e a move para o diretório de imagens
    if (isset($_FILES['imagem'])){
        $produto->setImagem(uniqid() . $_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $produto->getImagemDiretorio());
    }

    // Cria uma instância do Repositório de Produtos, passando a conexão PDO como parâmetro
    $produtoRepositorio = new ProdutoRepositorio($pdo);

    // Salva o produto no banco de dados
    $produtoRepositorio->salvar($produto);

    // Redireciona para a página de administração após o cadastro
    header("Location: admin.php");
}

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
    <link rel="stylesheet" href="css/form.css">
    <!-- Links para fontes no Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cadastrar Produto</title>
</head>
<body>
<main>
    <!-- Seção do banner da administração -->
    <section class="container-admin-banner">
        <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
        <h1>Cadastro de Produtos</h1>
        <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <!-- Seção do formulário de cadastro de produtos -->
    <section class="container-form">
        <form method="post" enctype="multipart/form-data">

            <!-- Campos do formulário -->
            <label for="nome">Nome</label>
            <input name="nome" type="text" id="nome" placeholder="Digite o nome do produto" required>

            <div class="container-radio">
                <div>
                    <label for="cafe">Café</label>
                    <input type="radio" id="cafe" name="tipo" value="Café" checked>
                </div>
                <div>
                    <label for="almoco">Almoço</label>
                    <input type="radio" id="almoco" name="tipo" value="Almoço">
                </div>
            </div>

            <label for="descricao">Descrição</label>
            <input name="descricao" type="text" id="descricao" placeholder="Digite uma descrição" required>

            <label for="preco">Preço</label>
            <input name="preco" type="text" id="preco" placeholder="Digite uma descrição" required>

            <label for="imagem">Envie uma imagem do produto</label>
            <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem">

            <!-- Botão de envio do formulário -->
            <input name="cadastro" type="submit" class="botao-cadastrar" value="Cadastrar produto"/>
        </form>
    </section>
</main>

<!-- Scripts JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>
