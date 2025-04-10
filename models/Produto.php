<?php
// Classe entidade Produto
// Representa uma Produto com seus atributos

  class Produto{
    // Atributos privados da classe Produto
    private $nome, $preco, $descricao, $imagem;

    // Método para definir o preco da produto
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    // os outros métodos getters e setters para os demais atributos
    public function setPreco($preco){
        $this->preco = $preco;
    }

    // Método para obter o preco do produto
    public function getPreco(){
        return $this->preco;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setImagem($imagem){
        $this->imagem = $imagem;
    }

    public function getImagem(){
        return $this->imagem;
    }
  }
?>