<?php
require_once __DIR__ . '/../models/Loja.php';
require_once __DIR__ . '/../dao/LojaDAO.php';

class LojaController {
    public function consultar() {
        $lojaDAO = new LojaDAO();
        echo json_encode($lojaDAO->consultar());
    }

    public function cadastrar() {
        $lojaDAO = new LojaDAO();
        $usuario = new Loja();

        $usuario->setCpf(filter_input(INPUT_POST, 'cpf'));
        $usuario->setNome(filter_input(INPUT_POST, 'nome'));
        $usuario->setProfissao(filter_input(INPUT_POST, 'profissao'));
        $usuario->setTelefone(filter_input(INPUT_POST, 'telefone'));
        $usuario->setEmail(filter_input(INPUT_POST, 'email'));

        echo json_encode($lojaDAO->cadastrar($usuario));
    }

    public function atualizar() {
        $LojaDAO = new LojaDAO();
        $usuario = new Usuario();

        $usuario->setCpf(filter_input(INPUT_POST, 'cpf'));
        $usuario->setNome(filter_input(INPUT_POST, 'nome'));
        $usuario->setProfissao(filter_input(INPUT_POST, 'profissao'));
        $usuario->setTelefone(filter_input(INPUT_POST, 'telefone'));
        $usuario->setEmail(filter_input(INPUT_POST, 'email'));

        echo json_encode($LojaDAO->atualizar($usuario));
    }

    public function deletar() {
        $LojaDAO = new LojaDAO();
        $usuario = new Usuario();

        $usuario->setCpf(filter_input(INPUT_POST, 'cpf'));

        echo json_encode($LojaDAO->deletar($usuario));
    }
}