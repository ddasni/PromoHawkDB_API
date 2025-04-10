<?php
// Classe entidade Usuario
// Representa um Usuario com seus atributos

  class Usuario{
    // Atributos privados da classe Pessoa
    private $nome, $username, $telefone, $email, $senha;

    // Método para definir o nome verdadeiro da pessoa
    public function setNome($nome){
        $this->nome = $nome;
    }

    // Método para obter o nome verdadeiro da pessoa
    public function getNome(){
        return $this->nome;
    }

    // os outros métodos getters e setters para os demais atributos
    public function setUsername($username){
        $this->username = $username;
    }

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
  }