<?php

class ProdutoRepositorio
{
    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Método privado para criar um objeto Produto a partir dos dados do banco de dados
     * @param array $dados
     * @return Produto
     */
    private function formarObjeto(array $dados): Produto
    {
        return new Produto(
            $dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            (float) $dados['preco'], // Convertendo explicitamente para float
            $dados['imagem']

        );
    }


    /**
     * Método para obter opções de café do banco de dados
     * @return array
     */
    public function opcoesCafe(): array
    {
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statement = $this->pdo->query($sql1);
        $produtosCafe = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($cafe) {
            return $this->formarObjeto($cafe);
        }, $produtosCafe);
    }

    /**
     * Método para obter opções de almoço do banco de dados
     * @return array
     */
    public function opcoesAlmoco(): array
    {
        $sql2 = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $statement = $this->pdo->query($sql2);
        $produtosAlmoco = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($almoco) {
            return $this->formarObjeto($almoco);
        }, $produtosAlmoco);
    }
    public function buscarTodos(): array
    {
    $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($produto){
            return $this->formarObjeto($produto);
        },$dados);
    }

    public function deletar(int $id): void
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
    }

    public function salvar(Produto $produto)
    {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getPreco());
        $statement->bindValue(5, $produto->getImagem());
        $statement->execute();

    }
}
