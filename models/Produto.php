<?php
// Classe entidade Produto
// Representa uma Produto com seus atributos

  class Produto{
    // Atributos privados da classe Produto
    private $idProduto, $nomeProduto, $preco, $descricao, $imagem;

    // Método para definir o id do produto
    public function setIDProduto($idProduto){
        $this->idProduto = $idProduto;
    }

    public function getIDProduto(){
        return $this->idProduto;
    }

    // os outros métodos getters e setters para os demais atributos
    public function setNomeProduto($nomeProduto){
        $this->nomeProduto = $nomeProduto;
    }

    public function getNomeProduto(){
        return $this->nomeProduto;
    }

    public function setPrecoProduto($preco){
        $this->preco = $preco;
    }

    // Método para obter o preco do produto
    public function getPrecoProduto(){
        return $this->preco;
    }

    public function setDescricaoProduto($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricaoProduto(){
        return $this->descricao;
    }

    public function setImagemProduto($imagem){
        $this->imagem = $imagem;
    }

    public function getImagemProduto(){
        return $this->imagem;
    }
  }
?>