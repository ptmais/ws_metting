<?php

/**
 * Description of usuarioDAO
 *
 * @author Alexandre Andrade
 */
class DaoEvento {

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
        $idCategoria = $param->idCategoria;
        $nome = $param->nome;
        $descricao = $param->descricao;
        $endereco = $param->endereco;
        $localizacao = $param->localizacao;
        $preco = $param->preco;
        $qntMax = $param->qntMax;        
        $privado = $param->privado;
        $idadeMin = $param->idadeMin;
        // formatação da data do evento para aceite do banco de dados
        $time = strtotime($param->data);
        $data_evento = date('Y-m-d H:i:s', $time);

        // comando SQL
        $sql = "insert into evento(idUsuario,idCategoria,nome,descricao,endereco,localizacao,data,"
                . "preco,qntMax,privado,idadeMin) values ('$idUsuario','$idCategoria',"
                . "'$nome','$descricao','$endereco','$localizacao','$data_evento','$preco','$qntMax',"
                . "'$privado','$idadeMin')";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução tenha ocorrido com sucesso, o STATUS será 1
        if ($status_sql > 0) {
            $resposta["erro"] = false;
            $resposta["mensagem"] = EVENTO_INSERIDO_SUCESSO;
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
        $id = $param->id;
        $idCategoria = $param->idCategoria;
        $nome = $param->nome;
        $endereco = $param->endereco;
        $localizacao = $param->localizacao;
        $preco = $param->preco;
        $qntMax = $param->qntMax;
        $descricao = $param->descricao;
        $privado = $param->privado;
        $idadeMin = $param->idadeMin;
        // formatação da data do evento para aceite do banco de dados
        $time = strtotime($param->data);
        $data_evento = date('Y-m-d H:i:s', $time);

        // comando SQL
        $sql = "update evento set idCategoria ='$idCategoria',nome='$nome',"
                . "endereco='$endereco', localizacao ='$localizacao', data='$data_evento',preco ='$preco',"
                . "qntMax='$qntMax',descricao='$descricao',privado='$privado',idadeMin='$idadeMin' where"
                . " id = '$id'";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução tenha ocorrido com sucesso, o STATUS será 1
        if ($status_sql > 0) {
            $resposta["erro"] = false;
            $resposta["mensagem"] = EVENTO_ATUALIZADO_SUCESSO;
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
        $sql = "delete from evento where id='$id'";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução tenha ocorrido com sucesso, o STATUS será 1
        if ($status_sql > 0) {
            $resposta["erro"] = false;
            $resposta["mensagem"] = EVENTO_DELETADO_SUCESSO;
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
        $sql = "select *, date_format(data,'%Y-%m-%d %H:%i:%s') as data from evento where id=$id";

        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);

        // caso a execução não tenha ocorrido algum erro
        if (!mysqli_errno($this->conn)) {
            if (mysqli_num_rows($status_sql) > 0) {
                $resposta = mysqli_fetch_assoc($status_sql);
            } else {
                $resposta["erro"] = true;
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
    
    public function get_idCategoria($param) {
        // retorno
        $resposta = array();
        
        // coleta dos parâmetros e salva cada um deles em variaveis separadas
        $idCategoria = $param['id'];
        
        // comando SQL
        $sql = "select *, date_format(data,'%d-%c-%Y %H:%i:%s') as data from evento where idCategoria='$idCategoria'";
        
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
    
    public function get_idUsuario($param) {
        // retorno
        $resposta = array();
        
        // coleta dos parâmetros e salva cada um deles em variaveis separadas
        $idUsuario = $param['id'];
        
        // comando SQL
        $sql = "select *, date_format(data,'%d-%c-%Y %H:%i:%s') as data from evento where idUsuario='$idUsuario'";
        
        // execução do comando SQL e guarda seu STATUS de execução
        $status_sql = mysqli_query($this->conn, $sql);
        
        // caso a execução não tenha ocorrido algum erro
        if (!mysqli_errno($this->conn)) {
            if (mysqli_num_rows($status_sql) > 0) {
                $arquivos = array();
                while ($row = mysqli_fetch_assoc($status_sql)) {
                    $arquivos[] = $row;
                }
                $resposta = $arquivos;
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
