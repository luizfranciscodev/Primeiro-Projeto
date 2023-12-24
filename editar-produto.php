<?php
global $pdo;
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

$produtoRepositorio = new ProdutoRepositorio($pdo);

// Verifica se o formulário foi enviado para edição
if (isset($_POST['editar'])) {
    // Cria um novo objeto Produto com os dados do formulário
    $produto = new Produto(
        $_POST['id'],
        $_POST['tipo'],
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco']
    );

    // Se uma nova imagem foi fornecida, atualiza o caminho da imagem
    if (isset($_FILES['imagem'])) {
        $produto->setImagem(uniqid() . $_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $produto->getImagemDiretorio());
    }

    // Atualiza o produto no repositório
    $produtoRepositorio->atualizar($produto);

    // Redireciona de volta para a página de administração após a edição
    header("Location: admin.php");
} else {
    // Se não estiver editando, carrega as informações do produto existente para edição
    $produto = $produtoRepositorio->buscar($_GET['id']);
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <!-- Metadados do documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Links para folhas de estilo -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">

    <!-- Links para fontes do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Ícone da página -->
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">

    <!-- Título da página -->
    <title>Serenatto - Editar Produto</title>
</head>
<body>
<main>
    <!-- Seção principal do conteúdo da página -->
    <section class="container-admin-banner">
        <!-- Banner da administração -->
    </section>
    <section class="container-form">
        <!-- Formulário de edição do produto -->
        <form method="post" enctype="multipart/form-data">
            <!-- Campos do formulário preenchidos com dados do produto existente -->
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" value="<?= $produto->getNome()?>" required>

            <!-- Seleção do tipo de produto (Café ou Almoço) -->
            <div class="container-radio">
                <div>
                    <label for="cafe">Café</label>
                    <input type="radio" id="cafe" name="tipo" value="Café" <?= $produto->getTipo() == "Café" ? "checked" : "" ?>>
                </div>
                <div>
                    <label for="almoco">Almoço</label>
                    <input type="radio" id="almoco" name="tipo" value="Almoço" <?= $produto->getTipo() == "Almoço" ? "checked" : "" ?>>
                </div>
            </div>

            <!-- Outros campos do produto (descrição, preço, imagem) -->
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" value="<?= $produto->getDescricao()?>" placeholder="Digite uma descrição" required>

            <label for="preco">Preço</label>
            <input type="text" name="preco" id="preco" value="<?= number_format($produto->getPreco(), 2)?>" placeholder="Digite uma descrição" required>

            <label for="imagem">Envie uma imagem do produto</label>
            <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem">

            <!-- Campo oculto para armazenar o ID do produto -->
            <input type="hidden" name="id" value="<?= $produto->getId()?>">

            <!-- Botão de submit para editar o produto -->
            <input type="submit" name="editar" class="botao-cadastrar" value="Editar produto"/>
        </form>
    </section>
</main>

<!-- Scripts e outros elementos ao final do corpo da página -->
</body>
</html>
