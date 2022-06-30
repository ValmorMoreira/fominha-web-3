<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteDeRelatorios extends Teste
{
    public function testeRelatorios()
    {
        $resposta = $this->get(URL_RAIZ . 'relatorio');
        $this->verificarContem($resposta, 'Total de usuários');
        $resposta = $this->get(URL_RAIZ . 'relatorio');
        $this->verificarContem($resposta, 'Total de receitas');
        $resposta = $this->get(URL_RAIZ . 'relatorio');
        $this->verificarContem($resposta, 'Total de Comentários');
    }
}
