<?php

// Inclui o arquivo de conexão com o banco de dados
include "conexao.php";

    // Classe responsável por realizar operações de acesso a dados (DAO) para a entidade Usuario
    class UsuarioDAO{

        // Método para cadastrar um novo usuario no banco de dados
        // Insere dados na tabela 'usuario'
        public function cadastrar(Usuario $u){

            // SQL para inserir dados na 'TB_USUARIO'
            $sql_usuario = "insert into TB_USUARIO (NOME_USUARIO, NOME_VERDADEIRO, EMAIL_USUARIO, 
                            SENHA_USUARIO, TEL_USUARIO, IMG_USUARIO) values (?, ?, ?, ?, ?, ?)";

            //instanciar o objeto de conexão
            $bd = new Conexao();
            $con = $bd->getConexao();

            // Prepara e executa as consultas SQL
            $valor_usuario = $con->prepare($sql_usuario);
            $valor_usuario->bindValue(1, $u->getUsername());
            $valor_usuario->bindValue(2, $u->getNome());
            $valor_usuario->bindValue(3, $u->getEmail());
            $valor_usuario->bindValue(4, $u->getSenha());
            $valor_usuario->bindValue(5, $u->getTelefone());
            $valor_usuario->bindValue(6, $u->getImagem());       

            $resultado_usuario = $valor_usuario->execute();

            // Verifica se ambas as inserções foram bem-sucedidas
            if($resultado_usuario){
                return "cadastrado com sucesso";
            }
            else{
                return "erro ao cadastrar";
            }
        }

        //os demais métodos seguem a mesma lógica do primeiro
        public function deletar(Usuario $u){
            $sql_usuario = "delete from TB_USUARIO where ID_USUARIO=?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_usuario = $con->prepare($sql_usuario);
            $valor_usuario->bindValue(1, $u->getID());

            $resultado_usuario = $valor_usuario->execute();

            if($resultado_usuario){
                return "Apagado com sucesso";
            }
            else{
                return "erro ao apagar";
            }
        }

        public function atualizar(Usuario $u){
            $sql_usuario = "update TB_USUARIO set NOME_USUARIO=?, NOME_VERDADEIRO=?, EMAIL_USUARIO=?, 
                            SENHA_USUARIO=?, TEL_USUARIO=?, IMG_USUARIO=? where ID_USUARIO =?";

            $bd = new Conexao();
            $con = $bd->getConexao();

            $valor_usuario = $con->prepare($sql_usuario);
            $valor_usuario->bindValue(1, $u->getUsername());
            $valor_usuario->bindValue(2, $u->getNome());
            $valor_usuario->bindValue(3, $u->getEmail());
            $valor_usuario->bindValue(4, $u->getSenha());
            $valor_usuario->bindValue(5, $u->getTelefone());
            $valor_usuario->bindValue(6, $u->getImagem());    
            
            $resultado_usuario = $valor_usuario->execute();

            if($resultado_usuario){
                return "Atualizado com sucesso";
            }
            else{
                return "erro ao atualizar";
            }
        }


        public function consultar(Usuario $u){
    
            // Método para consultar a TB_USUARIO
            $sql_usuario = "SELECT * FROM TB_USUARIO WHERE ID_USUARIO = ?";
           
            // Obtém a conexão e executa a consulta
            $bd = new Conexao();
            $con = $bd->getConexao();
            
            if(!$con){
                return "está com erro";
            }

            $valor_usuario = $con->prepare($sql_usuario);
            $valor_usuario->bindValue(1, $u->getID());

            $resultado_usuario = $valor_usuario->execute();
            
            // Verifica se foram encontrados registros
            if($resultado_usuario->rowCount()>0){
                // Retorna os resultados em um array associativo
                $resultado = $resultado_usuario->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }else{
                return "erro";
            }
        }
    }
?>