<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;
use \Modelo\Usuario;
use \Modelo\Receita;

abstract class Controlador extends DW3Controlador
{
    use ControladorVisao;
    
    protected $usuario;

	protected function verificarLogado()
    {
    	$usuario = $this->getUsuario();
        if ($usuario == null) {
        	$this->redirecionar(URL_RAIZ . 'login');
        }
    }

    protected function getUsuario()
    {
        if ($this->usuario == null) {
        	$usuario = DW3Sessao::get('usuario');
        }
        return $usuario;
    }

    protected function getUsuarioSessao()
    {
        $usuarioId = DW3Sessao::get('usuario');
        if ($usuarioId == null) {
            return null;
        }
        $this->usuario = Usuario::buscarId($usuarioId);
        return $this->usuario;
    }

    protected function calcularPaginacao($busca, $quantidade, $orderBy = 'desc', $sqlQuery = null)
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;

            $limit = 3;
            $offset = ($pagina - 1) * $limit;
            $receitas = Receita::$busca($limit, $offset, $orderBy, $sqlQuery); 

        // if ($sqlQuery) {
        //     $receitas = Receita::$busca($limit, $offset, $orderBy, $sqlQuery);
        // } else {
        //     $receitas = Receita::$busca($limit, $offset, $orderBy);
        // }

        if($sqlQuery != null){
            $ultimaPagina = ceil(Receita::$quantidade($sqlQuery) / $limit);
        return compact('busca', 'pagina', 'receitas', 'ultimaPagina');
        }else{
            $ultimaPagina = ceil(Receita::$quantidade() / $limit);
            return compact('pagina', 'receitas', 'ultimaPagina');
        }
        
    }

}

