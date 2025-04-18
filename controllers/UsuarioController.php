<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioController {

    public function consultar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $usuario->setID(filter_input(INPUT_POST, 'id'));

        echo json_encode($usuarioDAO->consultar($usuario));
    }

    public function cadastrar() {
        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }
    
        $usuario = new Usuario();
    
        $usuario->setNome($dados->nome); // nome verdadeiro
        $usuario->setUsername($dados->username);
        $usuario->setTelefone($dados->telefone);
        $usuario->setImagem($dados->imagem);
        $usuario->setEmail($dados->email);
        $usuario->setSenha($dados->senha);
    
        $usuarioDAO = new UsuarioDAO();
        echo json_encode($usuarioDAO->cadastrar($usuario));
    }
    

    public function atualizar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $usuario->setNome(filter_input(INPUT_POST, 'nome'));
        $usuario->setUsername(filter_input(INPUT_POST, 'username'));
        $usuario->setImagem(filter_input(INPUT_POST, 'imagem'));
        $usuario->setTelefone(filter_input(INPUT_POST, 'telefone'));
        $usuario->setEmail(filter_input(INPUT_POST, 'email'));
        $usuario->setSenha(filter_input(INPUT_POST, 'senha'));

        echo json_encode($usuarioDAO->atualizar($usuario));
    }

    public function deletar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $usuario->setID(filter_input(INPUT_POST, 'id'));

        echo json_encode($usuarioDAO->deletar($usuario));
    }
}