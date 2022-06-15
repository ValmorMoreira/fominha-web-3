<?php

namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Não tem cadastro? Crie agora.');
    }

    public function testeLogin()
    {
        (new Usuario('João','joao@teste.com', '123456'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'joao@teste.com',
            'senha' => '123456'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'jo',
            'senha' => '12'
        ]);
        $this->verificarContem($resposta, 'Cadastro');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('João', 'joao@teste.com', '123456'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'joao@teste.com',
            'senha' => '123456'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'home');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }
}
