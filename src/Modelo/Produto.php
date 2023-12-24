<?php
class Produto
{
    private ?int $id; // Identificador único do produto (pode ser nulo se for um novo produto)
    private string $tipo; // Tipo do produto (Café, Almoço, etc.)
    private string $nome; // Nome do produto
    private string $descricao; // Descrição do produto
    private string $imagem; // Nome do arquivo de imagem do produto (padrão: "logo-serenatto.png")
    private float $preco; // Preço do produto

    /**
     * Construtor da classe Produto.
     *
     * @param int|null $id
     * @param string $tipo
     * @param string $nome
     * @param string $descricao
     * @param float $preco
     * @param string $imagem
     */
    public function __construct(?int $id, string $tipo, string $nome, string $descricao,  float $preco, string $imagem = "logo-serenatto.png")
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->preco = $preco;
    }

    /**
     * Obtém o ID do produto.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define a imagem do produto.
     *
     * @param string $imagem
     */
    public function setImagem(string $imagem): void
    {
        $this->imagem = $imagem;
    }

    /**
     * Obtém o tipo do produto.
     *
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * Obtém o nome do produto.
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Obtém a descrição do produto.
     *
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * Obtém o nome da imagem do produto.
     *
     * @return string
     */
    public function getImagem(): string
    {
        return $this->imagem;
    }

    /**
     * Obtém o diretório da imagem do produto.
     *
     * @return string
     */
    public function getImagemDiretorio(): string
    {
        return "img/".$this->imagem;
    }

    /**
     * Obtém o preço do produto.
     *
     * @return float
     */
    public function getPreco(): float
    {
        return $this->preco;
    }

    /**
     * Obtém o preço do produto formatado como uma string.
     *
     * @return string
     */
    public function getPrecoFormatado():string
    {
        return "R$ " . number_format($this->preco, 2);
    }
}
