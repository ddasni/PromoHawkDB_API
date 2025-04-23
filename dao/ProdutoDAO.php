<?php

// Inclui o arquivo de conexão com o banco de dados
include_once __DIR__ . "/../database/conexao.php";;

    // Classe responsável por realizar operações de acesso a dados (DAO) para a entidade Cupom
    class ProdutoDAO{

        public function consultar(?Produto $p=null){

            // Método para consultar todas as pessoas e seus contatos
            // Realiza um join entre as tabelas 'pessoa' e 'contato'
            $sql = "SELECT * FROM TB_PRODUTO";
            // verificar se vai usar inner join com a tabela cupom

            if ($p !== null) {
                $sql .= " WHERE ID_PRODUTO = ?"; // se for enviado um id vai incrementar o where no select * from
            }
           
            // Obtém a conexão e executa a consulta
            $bd = new Conexao();
            $con = $bd->getConexao();
            
            if(!$con){
                return "está com erro";
            }

            $valor = $con->prepare($sql);

            if ($p !== null) {
                $valor->bindValue(1, $p->getIDProduto());
            }

            $valor->execute();
            
            // Verifica se foram encontrados registros
            if($valor->rowCount()>0){
                // Retorna os resultados em um array associativo
                $resultado = $valor->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }else{
                return "erro";
            }
        }

        // Método para cadastrar um novo Cupom no banco de dados
        // Insere dados na tabela 'Cupom'
        public function cadastrar(Produto $p) {
            // instanciar o objeto de conexão
            $bd = new Conexao();
            $con = $bd->getConexao();
        
            // Inicia transação para segurança
            $con->beginTransaction();
        
            try {
                // Processo que verifica se o nome da loja e categoria já existem
                // se não existir vai cadastrar

                $sql_verificacaoLoja = "SELECT ID_LOJA FROM TB_LOJA WHERE NOME_LOJA = ?";
                $valor_loja = $con->prepare($sql_verificacaoLoja);
                $valor_loja->bindValue(1, $p->getNomeLoja());
                $valor_loja->execute();
        
                if ($valor_loja->rowCount() > 0) {
                    $row = $valor_loja->fetch(PDO::FETCH_ASSOC);
                    $idLoja = $row['ID_LOJA'];
                } 
                else {
                    $sql_loja = "INSERT INTO TB_LOJA (NOME_LOJA) VALUES (?)";
                    $valor_loja = $con->prepare($sql_loja);
                    $valor_loja->bindValue(1, $p->getNomeLoja());
                    $valor_loja->execute();
                    $idLoja = $con->lastInsertId();
                }

        
                $sql_verificacaoCategoria = "SELECT ID_CATEGORIA FROM TB_CATEGORIA WHERE NOME_CATEGORIA = ?";
                $valor_categoria = $con->prepare($sql_verificacaoCategoria);
                $valor_categoria->bindValue(1, $p->getNomeCategoria());
                $valor_categoria->execute();
        
                if ($valor_categoria->rowCount() > 0) {
                    $row = $valor_categoria->fetch(PDO::FETCH_ASSOC);
                    $idCategoria = $row['ID_CATEGORIA'];
                } 
                else {
                    $sql_categoria = "INSERT INTO TB_CATEGORIA (NOME_CATEGORIA) VALUES (?)";
                    $valor_categoria = $con->prepare($sql_categoria);
                    $valor_categoria->bindValue(1, $p->getNomeCategoria());
                    $valor_categoria->execute();
                    $idCategoria = $con->lastInsertId();
                }
        
                // SQL para inserir produto na 'TB_PRODUTO'
                $sql_produto = "INSERT INTO TB_PRODUTO (ID_PRODUTO, NOME_PRODUTO, PRECO_PRODUTO, IMAGEM_PRODUTO, DESCRICAO_PRODUTO, 
                                                        LINK_PRODUTO, ID_CATEGORIA, ID_LOJA) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $valor_produto = $con->prepare($sql_produto);
                $valor_produto->bindValue(1, $p->getIDProduto());
                $valor_produto->bindValue(2, $p->getNomeProduto());
                $valor_produto->bindValue(3, $p->getPrecoProduto());
                $valor_produto->bindValue(4, $p->getImagemProduto());
                $valor_produto->bindValue(5, $p->getDescricaoProduto());
                $valor_produto->bindValue(6, $p->getLinkProduto());
                $valor_produto->bindValue(7, $idCategoria);
                $valor_produto->bindValue(8, $idLoja);
                $valor_produto->execute();
        
                // Confirma a transação
                $con->commit();
                return "cadastrado com sucesso";
            } 
            catch (PDOException $e) {
                // Desfaz a transação em caso de erro
                $con->rollBack();
                return "Erro ao cadastrar: " . $e->getMessage();
            }
        }
        
        

        //os demais métodos seguem a mesma lógica do primeiro
        public function deletar(Produto $p){
            $sql_cupom = "DELETE FROM TB_PRODUTO where ID_PRODUTO=?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_produto = $con->prepare($sql_cupom);
            $valor_produto->bindValue(1, $p->getIDProduto());

            $resultado_Cupom = $valor_produto->execute();

            if($resultado_Cupom){
                return "Apagado com sucesso";
            }
            else{
                return "erro ao apagar";
            }
        }

        public function atualizar(Produto $p){
            $sql_produto = "UPDATE TB_PRODUTO set ID_PRODUTO=?, NOME_PRODUTO=?, PRECO_PRODUTO=?, IMAGEM_PRODUTO=?, 
                            DESCRICAO_PRODUTO=?, LINK_PRODUTO=? where ID_PRODUTO =?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_produto = $con->prepare($sql_produto);
            $valor_produto->bindValue(1, $p->getIDProduto());
            $valor_produto->bindValue(2, $p->getNomeProduto());
            $valor_produto->bindValue(3, $p->getPrecoProduto());
            $valor_produto->bindValue(4, $p->getImagemProduto());
            $valor_produto->bindValue(5, $p->getDescricaoProduto());
            $valor_produto->bindValue(6, $p->getLinkProduto());
            $valor_produto->bindValue(7, $p->getIDProduto());


            $resultado_Produto = $valor_produto->execute();

            if($resultado_Produto){
                return "Atualizado com sucesso";
            }
            else{
                return "erro ao atualizar";
            }
        }
    }
?>