<?php

namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;

class TesteUsuarios extends Teste
{
    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'cadastro');
        $this->verificarContem($resposta, 'Já tem cadastro? Faça o login aqui.');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastro', [
            'nome' => 'Bastião',
            'email' => 'tonho@teste.com',
            'senha' => '123456',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuario/sucesso');
        $resposta = $this->get(URL_RAIZ . 'usuario/sucesso');
        $this->verificarContem($resposta, 'Seja Bem Vindo(a)');
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE email = "tonho@teste.com"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }
}
