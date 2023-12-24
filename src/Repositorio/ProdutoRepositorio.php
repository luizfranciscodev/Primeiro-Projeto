<?php

class ProdutoRepositorio
{
    private PDO $pdo; // Propriedade privada para armazenar a instância do PDO

    /**
     * Construtor da classe que recebe uma instância do PDO.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo; // Atribui a instância do PDO à propriedade privada
    }

    /**
     * Método privado para criar um objeto Produto a partir de dados fornecidos.
     *
     * @param array $dados
     * @return Produto
     */
    private function formarObjeto($dados)
    {
        return new Produto(
            $dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            $dados['preco'],
            $dados['imagem']
        );
    }

    /**
     * Método para obter opções de café do banco de dados.
     *
     * @return array
     */
    public function opcoesCafe(): array
    {
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statement = $this->pdo->query($sql1);
        $produtosCafe = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosCafe = array_map(function ($cafe) {
            return $this->formarObjeto($cafe);
        }, $produtosCafe);

        return $dadosCafe;
    }

    /**
     * Método para obter opções de almoço do banco de dados.
     *
     * @return array
     */
    public function opcoesAlmoco(): array
    {
        $sql2 = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $statement = $this->pdo->query($sql2);
        $produtosAlmoco = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosAlmoco = array_map(function ($almoco) {
            return $this->formarObjeto($almoco);
        }, $produtosAlmoco);

        return $dadosAlmoco;
    }

    /**
     * Método para buscar todos os produtos no banco de dados.
     *
     * @return array
     */
    public function buscarTodos()
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $dados);

        return $todosOsDados;
    }

    /**
     * Método para deletar um produto no banco de dados com base no ID.
     *
     * @param int $id
     */
    public function deletar(int $id)
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
    }

    /**
     * Método para salvar um novo produto no banco de dados.
     *
     * @param Produto $produto
     */
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

    /**
     * Método para buscar um produto no banco de dados com base no ID.
     *
     * @param int $id
     * @return Produto
     */
    public function buscar(int $id)
    {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

    /**
     * Método para atualizar as informações de um produto no banco de dados.
     *
     * @param Produto $produto
     */
    public function atualizar(Produto $produto)
    {
        $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getPreco());
        $statement->bindValue(5, $produto->getImagem());
        $statement->bindValue(6, $produto->getId());
        $statement->execute();
    }
}
