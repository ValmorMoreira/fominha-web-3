<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteHome extends Teste
{
    public function testeIndex()
    {
        $resposta = $this->get(URL_RAIZ . 'home');
        $this->verificarContem($resposta, 'SEJA BEM VINDO!');
    }
}
