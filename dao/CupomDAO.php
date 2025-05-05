<?php

// Inclui o arquivo de conexão com o banco de dados
include_once __DIR__ . "/../database/conexao.php";;

    // Classe responsável por realizar operações de acesso a dados (DAO) para a entidade Pessoa
    class CupomDAO{

        public function consultar(?Cupom $c=null){

            // Método para consultar todas as pessoas e seus contatos
            // Realiza um join entre as tabelas 'pessoa' e 'contato'
            $sql = "SELECT * FROM TB_CUPOM";
            // verificar se vai usar inner join com a tabela cupom

            if ($c !== null) {
                $sql .= " WHERE ID_CUPOM = ?"; // se for enviado um id vai incrementar o where no select * from
            }
           
            // Obtém a conexão e executa a consulta
            $bd = new Conexao();
            $con = $bd->getConexao();
            
            if(!$con){
                return "está com erro";
            }

            $valor = $con->prepare($sql);

            if ($c !== null) {
                $valor->bindValue(1, $c->getIDCupom());
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
        public function cadastrar(Cupom $c) {
            // instanciar o objeto de conexão
            $bd = new Conexao();
            $con = $bd->getConexao();
        
            // Inicia transação para segurança
            $con->beginTransaction();
        
            try {
                $sql_verificacao = "SELECT ID_LOJA FROM TB_LOJA WHERE NOME_LOJA = ?";
                $stmt = $con->prepare($sql_verificacao);
                $stmt->bindValue(1, $c->getNomeLoja());
                $stmt->execute();
        
                if ($stmt->rowCount() > 0) {
                    // se a loja já existe ele vai pegar o id
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $idLoja = $row['ID_LOJA'];
                } 
                else {
                    // se a Loja não existe, então inser no banco de dados
                    $sql_loja = "INSERT INTO TB_LOJA (NOME_LOJA) VALUES (?)";
                    $stmt_loja = $con->prepare($sql_loja);
                    $stmt_loja->bindValue(1, $c->getNomeLoja());
                    $stmt_loja->execute();
                    $idLoja = $con->lastInsertId();
                }
        
                // SQL para inserir dados na 'TB_CUPOM'
                $sql_cupom = "INSERT INTO TB_CUPOM (CODIGO_CUPOM, DESCONTO_CUPOM, VALIDADE_CUPOM, ID_LOJA) VALUES (?, ?, ?, ?)";
                $valor_cupom = $con->prepare($sql_cupom);
                $valor_cupom->bindValue(1, $c->getCodigo());
                $valor_cupom->bindValue(2, $c->getDesconto());
                $valor_cupom->bindValue(3, $c->getValidade());
                $valor_cupom->bindValue(4, $idLoja);
                $valor_cupom->execute();
        
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
        public function deletar(Cupom $c){
            $sql_cupom = "DELETE FROM TB_CUPOM where ID_CUPOM=?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_cupom = $con->prepare($sql_cupom);
            $valor_cupom->bindValue(1, $c->getIDCupom());

            $resultado_Cupom = $valor_cupom->execute();

            if($resultado_Cupom){
                return "Apagado com sucesso";
            }
            else{
                return "erro ao apagar";
            }
        }

        public function atualizar(Cupom $c){
            $sql_cupom = "UPDATE TB_CUPOM set CODIGO_CUPOM=?, DESCONTO_CUPOM=?, DATA_VALIDADE=? where ID_Cupom =?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_cupom = $con->prepare($sql_cupom);
            $valor_cupom->bindValue(1, $c->getCodigo());
            $valor_cupom->bindValue(2, $c->getDesconto());
            $valor_cupom->bindValue(3, $c->getValidade());
            $valor_cupom->bindValue(4, $c->getIDCupom());

            $resultado_Cupom = $valor_cupom->execute();

            if($resultado_Cupom){
                return "Atualizado com sucesso";
            }
            else{
                return "erro ao atualizar";
            }
        }
    }
?>