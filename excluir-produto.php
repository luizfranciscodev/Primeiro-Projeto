<?php
// Inclui os arquivos necessários para a operação
global $pdo;
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

// Cria uma instância do Repositório de Produtos usando a conexão PDO
$produtoRepositorio = new ProdutoRepositorio($pdo);

// Obtém o ID do produto a ser excluído a partir do formulário POST
$idProdutoParaExcluir = $_POST['id'];

// Chama o método 'deletar' do Repositório para excluir o produto com o ID fornecido
$produtoRepositorio->deletar($idProdutoParaExcluir);

// Redireciona de volta para a página admin.php após a exclusão
header("Location: admin.php");
