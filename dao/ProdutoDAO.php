<?php

// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

    // Classe responsável por realizar operações de acesso a dados (DAO) para a entidade Cupom
    class ProdutoDAO{

        public function consultar(){
    
            // Método para consultar todas as pessoas e seus contatos
            // Realiza um join entre as tabelas 'pessoa' e 'contato'
            $sql = "select * from TB_PRODUTO";
           
            // Obtém a conexão e executa a consulta
            $bd = new Conexao();
            $con = $bd->getConexao();
            
            if(!$con){
                return "está com erro";
            }

            $valor = $con->prepare($sql);
            $valor->execute();
            
            // Verifica se foram encontrados registros
            if($valor->rowCount()>0){
                // Retorna os resultados em um array associativo
                $resultado = $valor->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }
            else{
                return "erro";
            }
        }

        public function consultarPorID(Produto $p){
            $sql_produto = "select * from TB_PRODUTO where ID_PRODUTO=?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_produto = $con->prepare($sql_produto);
            $valor_produto->bindValue(1, $p->getIDProduto());

            $resultado_usuario = $valor_produto->execute();

             // Verifica se foram encontrados registros
            if($valor_produto->rowCount()>0){
                // Retorna os resultados em um array associativo
                $resultado = $valor_produto->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }
            else{
                return "erro";
            }
        }

        // Método para cadastrar um novo Cupom no banco de dados
        // Insere dados na tabela 'Cupom'
        public function cadastrar(Produto $p){

            // SQL para inserir dados na tabela 'TB_PRODUTO'
            $sql_produto = "insert into TB_PRODUTO (ID_PRODUTO, NOME_PRODUTO, PRECO_PRODUTO, DESCRICAO_PRODUTO, IMAGEM_PRODUTO) 
            values (?, ?, ?, ?, ?)";

            // $sql_categoria = "insert into TB_CATEGORIA (NOME_CATEGORIA) value (?)";

            //instanciar o objeto de conexão
            $bd = new Conexao();
            $con = $bd->getConexao();

            // Prepara e executa as consultas SQL
            $valor_produto = $con->prepare($sql_produto);
            $valor_produto->bindValue(1, $p->getIDProduto());
            $valor_produto->bindValue(2, $p->getNomeProduto());
            $valor_produto->bindValue(3, $p->getPrecoProduto()); 
            $valor_produto->bindValue(4, $p->getDescricaoProduto()); 
            $valor_produto->bindValue(5, $p->getImagemProduto());       

            $resultado_produto = $valor_produto->execute();

            // Verifica se ambas as inserções foram bem-sucedidas
            if($resultado_produto){
                return "cadastrado com sucesso";
            }else{
                return "erro ao cadastrar";
            }
        }

        //os demais métodos seguem a mesma lógica do primeiro
        public function deletar(Produto $p){
            $sql_produto = "delete from TB_PRODUTO where ID_PRODUTO=?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_produto = $con->prepare($sql_produto);
            $valor_produto->bindValue(1, $p->getIDProduto());
            
            $resultado_produto = $valor_produto->execute();

            if($resultado_produto){
                return "Apagado com sucesso";
            }else{
                return "erro ao apagar";
            }
        }

        public function atualizar(Produto $p){
            $sql_produto = "update TB_PRODUTO set NOME_PRODUTO=?, PRECO_PRODUTO=?, IMAGEM_PRODUTO=? DESCRICAO_PRODUTO=? where ID_PRODUTO =?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_produto = $con->prepare($sql_produto);
            $valor_produto->bindValue(1, $p->getNomeProduto());
            $valor_produto->bindValue(2, $p->getPrecoProduto());
            $valor_produto->bindValue(3, $p->getImagemProduto());
            $valor_produto->bindValue(4, $p->getDescricaoProduto());      
            
            $resultado_produto = $valor_produto->execute();

            if($resultado_produto){
                return "Atualizado com sucesso";
            }else{
                return "erro ao atualizar";
            }
        }
    }
?>