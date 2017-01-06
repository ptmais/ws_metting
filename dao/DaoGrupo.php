<?php

/**
 * Description of usuarioDAO
 *
 * @author Alexandre Andrade
 */
class DaoGrupo {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/Conexao.php';
        require_once dirname(__FILE__) . '/Mensagens.php';
        // abrindo conexão
        $db = new Conexao();
        $this->conn = $db->conectar();
    }

    public function inserir($param) {
        // coleta dos parâmetros e salva cada um deles em variaveis separadas
        $nome = $param->nome;
        $idEvento = $param->idEvento;

        // comando SQL
        $sql = "insert into grupo (nome, idEvento) values ('$nome','$idEvento')";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução tenha ocorrido com sucesso, o STATUS será 1
        if ($status_sql > 0) {
            $resposta["erro"] = false;
            $resposta["mensagem"] = GRUPO_INSERIDO_SUCESSO;
        } else {
            // caso ocorra algum erro na execução, será informado o através do error MySQL
            $error = mysqli_error($this->conn);
            $resposta["erro"] = true;
            $resposta["mensagem"] = $error;
        }

        // fechamento da conexão
        mysqli_close($this->conn);

        // retorna a resposta da execução do comando SQL
        return $resposta;
    }

    public function atualizar_id($param) {
        // coleta dos parâmetros e salva cada um deles em variaveis separadas
        $nome = $param->nome;
        $id = $param->id;

        // comando SQL
        $sql = "update grupo set nome='$nome' where id='$id'";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução tenha ocorrido com sucesso, o STATUS será 1
        if ($status_sql > 0) {
            $resposta["erro"] = false;
            $resposta["mensagem"] = GRUPO_ATUALIZADO_SUCESSO;
        } else {
            // caso ocorra algum erro na execução, será informado o através do error MySQL
            $error = mysqli_error($this->conn);
            $resposta["erro"] = true;
            $resposta["mensagem"] = $error;
        }

        // fechamento da conexão
        mysqli_close($this->conn);

        // retorna a resposta da execução do comando SQL
        return $resposta;
    }

    function remover_id($param) {
        // coleta dos parâmetros e salva cada um deles em variaveis separadas
        $id = $param->id;

        // execução do comando SQL e guarda seu STATUS de execução
        $sql = "delete from grupo where id='$id'";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução tenha ocorrido com sucesso, o STATUS será 1
        if ($status_sql > 0) {
            $resposta["erro"] = false;
            $resposta["mensagem"] = GRUPO_DELETADO_SUCESSO;
        } else {
            // caso ocorra algum erro na execução, será informado o através do error MySQL
            $error = mysqli_error($this->conn);
            $resposta["erro"] = true;
            $resposta["mensagem"] = $error;
        }

        // fechamento da conexão
        mysqli_close($this->conn);

        // retorna a resposta da execução do comando SQL
        return $resposta;
    }

    function get_id($param) {
        // retorno
        $resposta = array();

        // coleta dos parâmetros e salva cada um deles em variaveis separadas
        $id = $param['id'];

        // comando SQL
        $sql = "select * from grupo where id='$id'";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução não tenha ocorrido algum erro
        if (!mysqli_errno($this->conn)) {
            if (mysqli_num_rows($status_sql) > 0) {
                $resposta = mysqli_fetch_assoc($status_sql);
            } else {
                $resposta["erro"] = false;
                $resposta["mensagem"] = GRUPO_NAO_ENCONTRADO;
            }
        } else {
            // caso ocorra algum erro na execução, será informado o através do error MySQL
            $error = mysqli_error($this->conn);
            $resposta["erro"] = true;
            $resposta["mensagem"] = $error;
        }

        // fechamando da conexão        
        mysqli_close($this->conn);

        // retorna a resposta da execução do comando SQL
        return $resposta;
    }

}
