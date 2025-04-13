<?php
// Classe entidade Usuario
// Representa uma Usuario com seus atributos

  class Usuario{
    // Atributos privados da classe Ususario
    private $id, $nome, $username, $telefone, $email, $senha, $imagem;

    // Método para definir o ID do usuario
    public function setID($id){
        $this->id = $id;
    }

    public function getID(){
        return $this->id;
    }


    // os outros métodos getters e setters para os demais atributos
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    // Método para obter o username da usuario
    public function getUsername(){
        return $this->username;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setImagem($imagem){
        $this->imagem = $imagem;
    }

    public function getImagem(){
        return $this->imagem;
    }
  }
?>