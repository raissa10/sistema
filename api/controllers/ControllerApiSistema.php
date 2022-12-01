<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ControllerApiSistema extends ControllerApiBase {

    public function callPing(Request $request, Response $response, array $args) {
        $data = array("Data Sistema" => date("Y-m-d H:i:s"));
        
        return $response->withJson($data, 200);
    }

    public function getUsuario(Request $request, Response $response, array $args) {
        $sSql = "SELECT * FROM tbusuario ORDER BY 1";

        $aDados = $this->getQuery()->selectAll($sSql);
        
        return $response->withJson($aDados, 200);
    }

    public function getPessoa(Request $request, Response $response, array $args) {
        $sSql = "SELECT * FROM tbpessoa ORDER BY 1";

        $aDados = $this->getQuery()->selectAll($sSql);
        
        return $response->withJson($aDados, 200);
    }

    public function getProduto(Request $request, Response $response, array $args) {
        $sSql = "SELECT * FROM tbproduto ORDER BY 1";

        $aDados = $this->getQuery()->selectAll($sSql);
        
        return $response->withJson($aDados, 200);
    }

}