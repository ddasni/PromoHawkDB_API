<?php

// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

    // Classe responsável por realizar operações de acesso a dados (DAO) para a entidade Cupom
    class CupomDAO{

        // Método para cadastrar um novo Cupom no banco de dados
        // Insere dados na tabela 'Cupom'
        public function cadastrar(Cupom $c){

            // SQL para inserir dados na tabela 'pessoa'
            $sql_usuario = "insert into TB_CUPOM (CODIGO_CUPOM, DESCONTO, DATA_VALIDADE) 
            values (?, ?, ?)";

            //instanciar o objeto de conexão
            $bd = new Conexao();
            $con = $bd->getConexao();

            // Prepara e executa as consultas SQL
            $valor_usuario = $con->prepare($sql_usuario);
            $valor_usuario->bindValue(1, $u->getCpf());
            $valor_usuario->bindValue(2, $u->getNome());
            $valor_usuario->bindValue(3, $u->getProfissao());       

            $resultado_pessoa = $valor_usuario->execute();

            // Verifica se ambas as inserções foram bem-sucedidas
            if($resultado_pessoa && $resultado_contato){
                return "cadastrado com sucesso";
            }else{
                return "erro ao cadastrar";
            }
        }

        //os demais métodos seguem a mesma lógica do primeiro
        public function deletar(Usuario $u){
            $sql_usuario = "delete from pessoa where cpf_pessoa=?";
            $sql_contato = "delete from contato where pessoa_contato = ?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_usuario = $con->prepare($sql_usuario);
            $valor_usuario->bindValue(1, $u->getCpf());

            $valor_contato = $con->prepare($sql_contato);
            $valor_contato->bindValue(1, $u->getCpf());        
            
            $resultado_pessoa = $valor_usuario->execute();
            $resultado_contato = $valor_contato->execute();

            if($resultado_pessoa && $resultado_contato){
                return "Apagado com sucesso";
            }else{
                return "erro ao apagar";
            }
        }

        public function atualizar(Usuario $u){
            $sql_usuario = "update pessoa set nome_pessoa=?, profissao_pessoa=? where cpf_pessoa =?";
            $sql_contato = "update contato set telefone_contato=?, email_contato=? where pessoa_contato=?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_usuario = $con->prepare($sql_usuario);
            $valor_usuario->bindValue(1, $u->getNome());
            $valor_usuario->bindValue(2, $u->getProfissao());
            $valor_usuario->bindValue(3, $u->getCpf());

            $valor_contato = $con->prepare($sql_contato);
            $valor_contato->bindValue(1, $u->getTelefone());
            $valor_contato->bindValue(2, $u->getEmail());
            $valor_contato->bindValue(3, $u->getCpf());      
            
            $resultado_pessoa = $valor_usuario->execute();
            $resultado_contato = $valor_contato->execute();

            if($resultado_pessoa && $resultado_contato){
                return "Atualizado com sucesso";
            }else{
                return "erro ao atualizar";
            }
        }


        public function consultar(){
    
            // Método para consultar todas as pessoas e seus contatos
            // Realiza um join entre as tabelas 'pessoa' e 'contato'
            $sql = "select * from pessoa inner join contato on pessoa.cpf_pessoa=contato.pessoa_contato";
           
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
    }
?>