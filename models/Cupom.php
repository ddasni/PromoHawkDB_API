<?php
class Cupom {

    private $idCupom, $codigo, $desconto, $validade, $idLoja, $nomeLoja;

    public function setIDCupom($idCupom){
        $this->idCupom = $idCupom;
    }

    public function getIDCupom(){
        return $this->idCupom;
    }

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


    // =========================================

    
    public function setIDLoja($idLoja){
        $this->idLoja = $idLoja;
    }

    public function getIDLoja(){
        return $this->idLoja;
    }

    public function setNomeLoja($nomeLoja){
        $this->nomeLoja = $nomeLoja;
    }

    public function getNomeLoja(){
        return $this->nomeLoja;
    }
}
?>