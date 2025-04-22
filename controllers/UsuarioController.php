<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioController {

    public function consultar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $dados = json_decode(file_get_contents("php://input"));

        if (!$dados || !isset($dados->id)) {
            echo json_encode(["erro" => "ID não fornecido"]);
            return;
        }

        $usuario->setID($dados->id);

        echo json_encode($usuarioDAO->consultar($usuario));
    }

    public function cadastrar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }
    
        $usuario->setNome($dados->nome);
        $usuario->setUsername($dados->username);
        $usuario->setTelefone($dados->telefone);
        $usuario->setImagem($dados->imagem);
        $usuario->setEmail($dados->email);

        // Gerando um hash de senha para guardar ela encriptografada no banco de dados
        // usando o "PASSWORD_DEFAULT" para sempre manter atualizado com novas tecnologias de hash
        $senhaHash = password_hash($dados->senha, PASSWORD_DEFAULT);
        $usuario->setSenha($senhaHash);
    
        $usuarioDAO = new UsuarioDAO();
        echo json_encode($usuarioDAO->cadastrar($usuario));
    }
    

    public function atualizar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }

        $usuario->setID($dados->id);
        $usuario->setNome($dados->nome);
        $usuario->setUsername($dados->username);
        $usuario->setTelefone($dados->telefone);
        $usuario->setImagem($dados->imagem);        
        $usuario->setEmail($dados->email);

        $senhaHash = password_hash($dados->senha, PASSWORD_DEFAULT);
        $usuario->setSenha($senhaHash);


        echo json_encode($usuarioDAO->atualizar($usuario));
    }

    public function deletar() {
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }

        $usuario->setID($dados->id);

        echo json_encode($usuarioDAO->deletar($usuario));
    }
}