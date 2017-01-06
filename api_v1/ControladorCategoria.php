<?php

/**
 * Description of controlador_usuario
 *
 * @author Alexandre
 */
require_once '../dao/DaoCategoria.php';

class ControladorCategoria {

    protected $ci;
    private $dao;

    public function __construct(Interop\Container\ContainerInterface $ci) {
        include_once dirname(__FILE__) . '/API_KEY.php';
        $this->ci = $ci;
        $this->dao = new DaoCategoria();
    }

    public function inserir($request, $response) {
        // verfica se está autorizado
        $autenticacao = $request->getHeader('Authorization');
        if ($autenticacao[0] == AUTH) {
            // pega os parametros do corpo da solicitação HTTP
            $param = json_decode($request->getBody());
            $resposta = $this->dao->inserir($param);
        } else {
            $resposta["erro"] = true;
            $resposta["mensagem"] = 'Comando não autorizado.';
        }
        return $response->withJson($resposta);
    }

    public function atualizar_id($request, $response) {
        // verfica se está autorizado
        $aut = $request->getHeader('Authorization');
        if ($aut[0] == AUTH) {
            // pega os parametros do corpo da solicitação HTTP
            $param = json_decode($request->getBody());
            $resposta = $this->dao->atualizar_id($param);
        } else {
            $resposta["erro"] = true;
            $resposta["mensagem"] = 'Comando não autorizado.';
        }
        return $response->withJson($resposta);
    }

    public function remover_id($request, $response) {
        // verfica se está autorizado
        $aut = $request->getHeader('Authorization');
        if ($aut[0] == AUTH) {
            // pega os parametros do corpo da solicitação HTTP
            $param = json_decode($request->getBody());
            $resposta = $this->dao->remover_id($param);
        } else {
            $resposta["erro"] = true;
            $resposta["mensagem"] = 'Comando não autorizado.';
        }
        return $response->withJson($resposta);
    }

    public function get_id($request, $response) {
        // verfica se está autorizado
        $aut = $request->getHeader('Authorization');
        if ($aut[0] == AUTH) {
            // pega os parametros do corpo da solicitação HTTP
            $param = $request->getQueryParams();
            $resposta = $this->dao->get_id($param);
        } else {
            $resposta["erro"] = true;
            $resposta["mensagem"] = 'Comando não autorizado.';
        }
        return $response->withJson($resposta);
    }

}
