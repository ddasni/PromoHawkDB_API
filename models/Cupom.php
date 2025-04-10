<?php
// Classe entidade Cupom
// Representa uma Cupom com seus atributos

  class Cupom{
    // Atributos privados da classe Pessoa
    private $codigo, $desconto, $validade;

    // Método para definir o codigo do Cupom
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    // Método para obter o codigo do Cupom
    public function getCodigo(){
        return $this->codigo;
    }

    // os outros métodos getters e setters para os demais atributos
    public function setDesconto($desconto){
        $this->desconto = $desconto;
    }

    public function getDesconto(){
        return $this->desconto;
    }

    public function setValidade($validade){
        $this->validade = $validade;
    }

    public function getValidade(){
        return $this->validade;
    }
  }
?>