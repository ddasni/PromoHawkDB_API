<?php
// Classe entidade Usuario
// Representa uma Usuario com seus atributos

  class Usuario{
    // Atributos privados da classe Pessoa
    private $cpf, $nome, $profissao, $telefone, $email;

    // Método para definir o CPF da pessoa
    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    // Método para obter o CPF da pessoa
    public function getCpf(){
        return $this->cpf;
    }

    // os outros métodos getters e setters para os demais atributos
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setProfissao($profissao){
        $this->profissao = $profissao;
    }

    public function getProfissao(){
        return $this->profissao;
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
  }