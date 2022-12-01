<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Chamada da api Folha Pagamento
 */
require_once("ControllerApiBase.php");
class ControllerApiFolhaPagamento extends ControllerApiBase {
    
    public function index(Request $request, Response $response, array $args) {
        $sSql = "SELECT * FROM tbfolha ORDER BY 1";
    
        $aDados = $this->getQuery()->selectAll($sSql);
    
        return $response->withJson($aDados, 200);
    }
    
    public function detalhaFolha(Request $request, Response $response, array $args) {
        $codigofolha = intval($args['codigofolha']);
        if($codigofolha > 0){
            $sSql = " select tbfolhadetalhe.codigoverba,
                             tbfolhaverba.descricao as verba,
                             tbfolhadetalhe.quantidade,
                             tbfolhaverba.valorunitario,
                             tbfolhadetalhe.provento,
                             tbfolhadetalhe.desconto
                        from tbfolhaverba
                  inner join tbfolhadetalhe on (tbfolhadetalhe.codigoverba = tbfolhaverba.id)
                       where tbfolhadetalhe.focodigo = $codigofolha";
        
            $aDados = $this->getQuery()->selectAll($sSql);
            
            return $response->withJson($aDados, 200);
        }
    
        $aDados = array("status" => false, "mensagem" => "Não foi informado o parametro 'codigofolha'!");
        
        return $response->withJson($aDados, 400);
    }
}
