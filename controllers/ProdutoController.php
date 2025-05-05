<?php
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../dao/ProdutoDAO.php';

class ProdutoController {
    public function consultar() {
        $produtoDAO = new ProdutoDAO();
        $produto = new Produto();

        $dados = json_decode(file_get_contents("php://input"));

        // Verificando se foi enviado o id, se não foi enviado vai fazer uma consulta padrão
        if (!$dados || !isset($dados->id)) {
            echo json_encode($produtoDAO->consultar());
            return;
        }

        $produto->setIDProduto($dados->id);
        echo json_encode($produtoDAO->consultar($produto));
    }

    public function cadastrar() {
        $produtoDAO = new ProdutoDAO();
        $produto = new Produto();

        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }

        $produto->setIDProduto($dados->idProduto);
        $produto->setNomeProduto($dados->nomeProduto);
        $produto->setPrecoProduto($dados->precoProduto);
        $produto->setDescricaoProduto($dados->descricaoProduto);
        $produto->setImagemProduto($dados->imagemProduto);
        $produto->setLinkProduto($dados->linkProduto);
        $produto->setNomeCategoria($dados->nomeCategoria);
        $produto->setNomeLoja($dados->nomeLoja);

        echo json_encode($produtoDAO->cadastrar($produto));
    }

    public function atualizar() {
        $produtoDAO = new ProdutoDAO();
        $produto = new Produto();

        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }

        $produto->setIDProduto($dados->idProduto);
        $produto->setNomeProduto($dados->nomeProduto);
        $produto->setPrecoProduto($dados->precoProduto);
        $produto->setDescricaoProduto($dados->descricaoProduto);
        $produto->setImagemProduto($dados->imagemProduto);
        $produto->setLinkProduto($dados->linkProduto);

        echo json_encode($produtoDAO->atualizar($produto));
    }

    public function deletar() {
        $produtoDAO = new ProdutoDAO();
        $produto = new Produto();

        $dados = json_decode(file_get_contents("php://input"));
    
        if (!$dados) {
            echo json_encode(["erro" => "Dados inválidos"]);
            return;
        }

        $produto->setIDProduto($dados->idProduto);

        echo json_encode($produtoDAO->deletar($produto));
    }
}