<?php
require_once __DIR__ . '/../config/config.php';

class Conexao{  
    // Atributo estático para armazenar a única instância da conexão
    private static $instancia;

    // Método estático para obter a conexão com o banco de dados
    public static function getConexao(){
        // Verifica se a instância já existe
        if(!isset(self::$instancia)){
            // Cria uma nova conexão com o banco de dados
            self::$instancia = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
            return self::$instancia;
        }
        else{
            // Retorna a instância da conexão
            return self::$instancia;
        }  
    }
  }
?>