<?php

/**
 * Description of usuarioDAO
 *
 * @author Alexandre Andrade
 */
class DaoEventoConfirmado {

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
        $idUsuario = $param->idUsuario;
        $idEvento = $param->idEvento;

        // comando SQL
        $sql = "insert into eventoConfirmado (idUsuario,idEvento) values ('$idUsuario','$idEvento')";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução tenha ocorrido com sucesso, o STATUS será 1
        if ($status_sql > 0) {
            $resposta["erro"] = false;
            $resposta["mensagem"] = EVENTOCONFIRMADO_INSERIDO_SUCESSO;
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
        $sql = "delete from eventoConfirmado where id='$id'";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução tenha ocorrido com sucesso, o STATUS será 1
        if ($status_sql > 0) {
            $resposta["erro"] = false;
            $resposta["mensagem"] = EVENTOCONFIRMADO_DELETADO_SUCESSO;
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

    function get_idUsuario($param) {
        // retorno
        $resposta = array();

        // coleta dos parâmetros e salva cada um deles em variaveis separadas
        $idUsuario = $param['id'];

        // comando SQL
        $sql = "select * from eventoConfirmado where idUsuario='$idUsuario'";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução não tenha ocorrido algum erro
        if (!mysqli_errno($this->conn)) {
            if (mysqli_num_rows($status_sql) > 0) {
                while ($row = mysqli_fetch_assoc($status_sql)) {
                    $resposta[] = $row;
                }
            } else {
                $resposta["erro"] = true;
                $resposta["mensagem"] = EVENTOCONFIRMADO_NAO_ENCONTRADO;
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

    public function get_idEvento($param) {
        // retorno
        $resposta = array();

        // coleta dos parâmetros e salva cada um deles em variaveis separadas
        $idEvento = $param['id'];

        // comando SQL
        $sql = "select * from eventoConfirmado where idEvento='$idEvento'";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução não tenha ocorrido algum erro
        if (!mysqli_errno($this->conn)) {
            if (mysqli_num_rows($status_sql) > 0) {
                while ($row = mysqli_fetch_assoc($status_sql)) {
                    $resposta[] = $row;
                }
            } else {
                $resposta["erro"] = false;
                $resposta["mensagem"] = EVENTO_NAO_ENCONTRADO;
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
