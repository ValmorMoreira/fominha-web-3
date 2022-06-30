<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
    public function testeInserir()
    {
        $usuario = (new Usuario('Valmor', 'valmor@teste.com', '12345'))->salvar();

        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE id = ' . $usuario->getId());

        $usuariosDoBanco = $query->fetchAll();

        $this->verificar(count($usuariosDoBanco) == 1);
    }

    public function testeBuscarEmail()
    {
       (new Usuario('Valmor', 'valmor@teste.com', '12345'))->salvar();

        $usuarioLogin = Usuario::buscarEmail('valmor@teste.com');
        $this->verificar($usuarioLogin != null);
    }

    public function testeBuscarPorId()
    {
        $usuario = (new Usuario('Valmor', 'valmor@teste.com', '12345'))->salvar();
        $usuarioBusca = Usuario::buscarId($usuario->getId());

        $this->verificar($usuario->getId() == $usuarioBusca->getId());
    }

    public function testeContarTodos()
    {
        (new Usuario('Admin', 'admin@google.com', 'master2022'))->salvar();
        (new Usuario('Valmor', 'valmor@teste.com', '12345'))->salvar();
        (new Usuario('Batman', 'batman@gotham.com', 'morcego'))->salvar();

        $totalDeUsuarios = Usuario::contarTodos();
        $this->verificar($totalDeUsuarios == 3);
    }
}
