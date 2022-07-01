<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
    public function testeInserir()
    {
        $usuario = $this->criarUmUsuario();

        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE id = ' . $usuario->getId());

        $usuariosDoBanco = $query->fetchAll();

        $this->verificar(count($usuariosDoBanco) == 1);
    }

    public function testeBuscarEmail()
    {
       $this->criarUmUsuario();

       $email = 'valmor@teste.com';

        $usuarioLogin = Usuario::buscarEmail($email);
        $this->verificar($usuarioLogin != null);
    }

    public function testeBuscarNome()
    {
        $this->criarUmUsuario();

       $nome = 'Valmor';

        $usuarioLogin = Usuario::buscarNome($nome);
        $this->verificar($usuarioLogin != null);
    }

    public function testeBuscarPorId()
    {
        $usuario = $this->criarUmUsuario();

        $usuarioBusca = Usuario::buscarId($usuario->getId());

        $this->verificar($usuario->getId() == $usuarioBusca->getId());
    }

    public function testeContarTodos()
    {
       $this->criarUsuarios();

        $totalDeUsuarios = Usuario::contarTodos();
        $this->verificar($totalDeUsuarios == 3);
    }

    public function criarUsuarios(){

        (new Usuario('Admin', 'admin@google.com', 'master2022'))->salvar();
        (new Usuario('Valmor', 'valmor@teste.com', '12345'))->salvar();
        (new Usuario('Batman', 'batman@gotham.com', 'morcego'))->salvar();
    }

    public function criarUmUsuario(){

        $usuario = (new Usuario('Valmor', 'valmor@teste.com', '12345'))->salvar();
        return $usuario;
    }
}
