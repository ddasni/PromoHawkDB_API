<?php
require_once './models/Cupom.php';
require_once './dao/CupomDAO.php';

class UsuarioController {
    public function consultar() {
        $usuarioDAO = new CupomDAO();
        echo json_encode($usuarioDAO->consultar());
    }

    public function cadastrar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $usuario->setCpf(filter_input(INPUT_POST, 'cpf'));
        $usuario->setNome(filter_input(INPUT_POST, 'nome'));
        $usuario->setProfissao(filter_input(INPUT_POST, 'profissao'));
        $usuario->setTelefone(filter_input(INPUT_POST, 'telefone'));
        $usuario->setEmail(filter_input(INPUT_POST, 'email'));

        echo json_encode($usuarioDAO->cadastrar($usuario));
    }

    public function atualizar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $usuario->setCpf(filter_input(INPUT_POST, 'cpf'));
        $usuario->setNome(filter_input(INPUT_POST, 'nome'));
        $usuario->setProfissao(filter_input(INPUT_POST, 'profissao'));
        $usuario->setTelefone(filter_input(INPUT_POST, 'telefone'));
        $usuario->setEmail(filter_input(INPUT_POST, 'email'));

        echo json_encode($usuarioDAO->atualizar($usuario));
    }

    public function deletar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $usuario->setCpf(filter_input(INPUT_POST, 'cpf'));

        echo json_encode($usuarioDAO->deletar($usuario));
    }
}