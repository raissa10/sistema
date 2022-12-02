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
    
    public function getConsultaUsuario(Request $request, Response $response, array $args) {
        $body = $request->getParsedBody();
        $campofiltro    = isset($body["campofiltro"]) ? $body["campofiltro"] : false;
        $operadorfiltro = isset($body["operadorfiltro"]) ? $body["operadorfiltro"] : false;
        $valorfiltro    = isset($body["valorfiltro"]) ? $body["valorfiltro"] : false;
    
        // Se tiver todos os parametros de filtro, cria o sql para executar a consulta filtrada
        if($campofiltro && $operadorfiltro && $valorfiltro){
            switch ($operadorfiltro){
                case "contem";
                    $operadorfiltro = " ilike ";
                    $valorfiltro = "'%$valorfiltro%'";
                break;
                case "naocontem";
                    $operadorfiltro = " not ilike ";
                    $valorfiltro = "'%$valorfiltro%'";
                    break;
                case "menor";
                    $operadorfiltro = " < ";
                    break;
                case "maior";
                    $operadorfiltro = " > ";
                    break;
                case "menorigual";
                    $operadorfiltro = " <= ";
                    break;
                case "maiorigual";
                    $operadorfiltro = " >= ";
                    break;
                case "igual";
                    $operadorfiltro = " = ";
                    break;
                case "diferente";
                    $operadorfiltro = " <> ";
                    break;
            }
            
            $sSql = "SELECT * FROM tbusuario WHERE $campofiltro $operadorfiltro $valorfiltro ORDER BY 1";
            
            if($operadorfiltro == "todos"){
                $sSql = "SELECT * FROM tbusuario ORDER BY 1";
            }
        } else {
            // Senao cria o sql para executar listando todos os dados
            $sSql = "SELECT * FROM tbusuario ORDER BY 1";
        }
        
        $aDados = $this->getQuery()->selectAll($sSql);
        
        return $response->withJson($aDados, 200);
    }
    
}
