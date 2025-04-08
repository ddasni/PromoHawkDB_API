<?php

// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

    // Classe responsável por realizar operações de acesso a dados (DAO) para a entidade Pessoa
    class UsuarioDAO{

        // Método para cadastrar uma nova pessoa no banco de dados
        // Insere dados na tabela 'pessoa' e 'contato'
        public function cadastrar(Usuario $p){

            // SQL para inserir dados na tabela 'pessoa'
            $sql_pessoa = "insert into pessoa (cpf_pessoa, nome_pessoa, profissao_pessoa) 
            values (?, ?, ?)";
            // SQL para inserir dados na tabela 'contato'
            $sql_contato = "insert into contato(telefone_contato, email_contato, pessoa_contato) values
            (?, ?, ?)";

            //instanciar o objeto de conexão
            $bd = new Conexao();
            $con = $bd->getConexao();

            // Prepara e executa as consultas SQL
            $valor_pessoa = $con->prepare($sql_pessoa);
            $valor_pessoa->bindValue(1, $p->getCpf());
            $valor_pessoa->bindValue(2, $p->getNome());
            $valor_pessoa->bindValue(3, $p->getProfissao());

            // Prepara e executa as consultas SQL
            $valor_contato = $con->prepare($sql_contato);
            $valor_contato->bindValue(1, $p->getTelefone());
            $valor_contato->bindValue(2, $p->getEmail());
            $valor_contato->bindValue(3, $p->getCpf());        

            $resultado_pessoa = $valor_pessoa->execute();
            $resultado_contato = $valor_contato->execute();

            // Verifica se ambas as inserções foram bem-sucedidas
            if($resultado_pessoa && $resultado_contato){
                return "cadastrado com sucesso";
            }else{
                return "erro ao cadastrar";
            }
        }

        //os demais métodos seguem a mesma lógica do primeiro
        public function deletar(Usuario $p){
            $sql_pessoa = "delete from pessoa where cpf_pessoa=?";
            $sql_contato = "delete from contato where pessoa_contato = ?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_pessoa = $con->prepare($sql_pessoa);
            $valor_pessoa->bindValue(1, $p->getCpf());

            $valor_contato = $con->prepare($sql_contato);
            $valor_contato->bindValue(1, $p->getCpf());        
            
            $resultado_pessoa = $valor_pessoa->execute();
            $resultado_contato = $valor_contato->execute();

            if($resultado_pessoa && $resultado_contato){
                return "Apagado com sucesso";
            }else{
                return "erro ao apagar";
            }
        }

        public function atualizar(Usuario $p){
            $sql_pessoa = "update pessoa set nome_pessoa=?, profissao_pessoa=? where cpf_pessoa =?";
            $sql_contato = "update contato set telefone_contato=?, email_contato=? where pessoa_contato=?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_pessoa = $con->prepare($sql_pessoa);
            $valor_pessoa->bindValue(1, $p->getNome());
            $valor_pessoa->bindValue(2, $p->getProfissao());
            $valor_pessoa->bindValue(3, $p->getCpf());

            $valor_contato = $con->prepare($sql_contato);
            $valor_contato->bindValue(1, $p->getTelefone());
            $valor_contato->bindValue(2, $p->getEmail());
            $valor_contato->bindValue(3, $p->getCpf());      
            
            $resultado_pessoa = $valor_pessoa->execute();
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