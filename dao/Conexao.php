<?php

/**
 * Description of conexao
 *
 * @author Alexandre
 */
class Conexao {

    private $conn;

    function __construct() {
        
    }

    function conectar() {
        include_once dirname(__FILE__) . '/Config.php';
        // conectando com o banco de dados MySQL
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // verifica se ocorreu algum erro de conexão
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        // retorna a conexão
        return $this->conn;
    }

}
