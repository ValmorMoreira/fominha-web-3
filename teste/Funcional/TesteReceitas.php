<?php

namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;
use Modelo\Receita;
use \Modelo\Usuario;

class TesteReceitas extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'Selecione uma categoria');
    }

    public function testeListagem()
    {
        $this->logar();
        (new Receita('carne de panela','carnes', 'agua', 'trigo', '2021-05-01', $this->usuario->getId()))->salvar();
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'Usuário');
        $this->verificarContem($resposta, 'carne de panela');
    }

    public function testeArmazenar()
    {
        $this->logar();
        $resposta = $this->post(URL_RAIZ . 'receitas/cadastrar', [
            'nome' => 'carne de panela',
            'categoria' => 'carnes',
            'ingredientes' => 'Carne bovina de panela',
            'modo_de_preparo' => 'cortar a carne em cubos e temperar a gosto',
            'data_receita' => '2021-05-01',
            'usuario_id' =>  $this->usuario->getId(),
        ]);
        $query = DW3BancoDeDados::query('SELECT * FROM receitas');
        $bdReceitas = $query->fetchAll();
        $this->verificar(count($bdReceitas) == 1);
    }

}
