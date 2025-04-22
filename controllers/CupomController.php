<?php
require_once __DIR__ . '/../models/Cupom.php';
require_once __DIR__ . '/../dao/CupomDAO.php';

class CupomController {

    public function consultar() {
        $cupomDAO = new CupomDAO();
        $cupom = new Cupom();

        $dados = json_decode(file_get_contents("php://input"));

        // Verificando se foi enviado o id, se não foi enviado vai fazer uma consulta padrão
        if (!$dados || !isset($dados->id)) {
            echo json_encode($cupomDAO->consultar());
            return;
        }

        $cupom->setIDCupom($dados->id);
        echo json_encode($cupomDAO->consultar($cupom));
    }

    public function cadastrar() {
        $CupomDAO = new CupomDAO();
        $cupom = new Cupom();

        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }

        $cupom->setNomeLoja($dados->nomeLoja);
        $cupom->setCodigo($dados->codigo);
        $cupom->setDesconto($dados->desconto);
        $cupom->setValidade($dados->validade);

        echo json_encode($CupomDAO->cadastrar($cupom));
    }

    public function atualizar() {
        $CupomDAO = new cupomDAO();
        $cupom = new Cupom();

        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }
        
        $cupom->setIDCupom($dados->id);
        $cupom->setCodigo($dados->codigo);
        $cupom->setDesconto($dados->desconto);
        $cupom->setValidade($dados->validade);

        echo json_encode($CupomDAO->atualizar($cupom));
    }

    public function deletar() {
        $CupomDAO = new cupomDAO();
        $cupom = new Cupom();

        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }

        $cupom->setIDCupom($dados->id);

        echo json_encode($CupomDAO->deletar($cupom));
    }
}