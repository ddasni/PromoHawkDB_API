<?php

// Inclui o arquivo de conexão com o banco de dados
include_once __DIR__ . "/../database/conexao.php";;

    // Classe responsável por realizar operações de acesso a dados (DAO) para a entidade Pessoa
    class LojaDAO{

        public function consultar(){
    
            // Método para consultar todas as pessoas e seus contatos
            // Realiza um join entre as tabelas 'pessoa' e 'contato'
            $sql = "select * from TB_LOJA";
            // verificar se vai usar inner join com a tabela cupom
           
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
            }else{
                return "erro";
            }
        }

        public function consultarPorID(Loja $l){
            $sql_loja = "select * from TB_LOJA where ID_LOJA=?";
            // verificar se vai usar inner join com a tabela cupom

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_loja = $con->prepare($sql_loja);
            $valor_loja->bindValue(1, $l->getIDLoja());

            $resultado_usuario = $valor_loja->execute();

             // Verifica se foram encontrados registros
            if($valor_loja->rowCount()>0){
                // Retorna os resultados em um array associativo
                $resultado = $valor_loja->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }
            else{
                return "erro";
            }
        }

        // Método para cadastrar uma nova loja e cupom no banco de dados
        // Insere dados na tabela 'loja' e 'cupom'
        public function cadastrar(Loja $l){

            // SQL para inserir dados na tabela 'TB_LOJA'
            $sql_loja = "insert into TB_LOJA (NOME_LOJA) values
            (?)";
            
            // SQL para inserir dados na tabela 'TB_CUPOM'
            $sql_cupom = "insert into TB_CUPOM (CODIGO_CUPOM, DATA_VALIDADE) values
            (?, ?)";
            

            //instanciar o objeto de conexão
            $bd = new Conexao();
            $con = $bd->getConexao();

            // Prepara e executa as consultas SQL
            $valor_loja = $con->prepare($sql_loja);
            $valor_loja->bindValue(1, $l->getNomeLoja());

            // Prepara e executa as consultas SQL
            $valor_cupom = $con->prepare($sql_cupom);
            $valor_cupom->bindValue(1, $l->getCodigo());
            $valor_cupom->bindValue(2, $l->getValidade());

            $resultado_loja = $valor_loja->execute();
            $resultado_cupom = $valor_cupom->execute();

            // Verifica se ambas as inserções foram bem-sucedidas
            if($resultado_loja && $resultado_cupom){
                return "cadastrado com sucesso";
            }else{
                return "erro ao cadastrar";
            }
        }

        //os demais métodos seguem a mesma lógica do primeiro
        public function deletar(Loja $l){
            $sql_loja = "delete from TB_LOJA where ID_LOJA=?";
            $sql_cupom = "delete from TB_CUPOM where ID_CUPOM=?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_loja = $con->prepare($sql_loja);
            $valor_loja->bindValue(1, $l->getIDLoja());

            $valor_cupom = $con->prepare($sql_cupom);
            $valor_cupom->bindValue(1, $l->getIDCupom());        
            
            $resultado_loja = $valor_loja->execute();
            $resultado_cupom = $valor_cupom->execute();

            if($resultado_loja && $resultado_cupom){
                return "Apagado com sucesso";
            }else{
                return "erro ao apagar";
            }
        }

        public function atualizar(Loja $l){
            $sql_loja = "update TB_LOJA set NOME_LOJA=? where ID_LOJA =?";
            $sql_cupom = "update TB_CUPOM set CODIGO_CUPOM=?, DATA_VALIDADE=? where ID_CUPOM=?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_loja = $con->prepare($sql_loja);
            $valor_loja->bindValue(1, $l->getIDLoja());
            $valor_loja->bindValue(2, $l->getNomeLoja());

            $valor_cupom = $con->prepare($sql_cupom);
            $valor_cupom->bindValue(1, $l->getIDCupom());
            $valor_cupom->bindValue(2, $l->getCodigo());
            $valor_cupom->bindValue(3, $l->getValidade());      
            
            $resultado_loja = $valor_loja->execute();
            $resultado_cupom = $valor_cupom->execute();

            if($resultado_loja && $resultado_cupom){
                return "Atualizado com sucesso";
            }else{
                return "erro ao atualizar";
            }
        }
    }
?>