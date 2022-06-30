<?php

namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function criar()
    {
        $this->visao('login/index.php');
        
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarEmail($_POST['email']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId());
            DW3Sessao::set('nome-usuario', $usuario->getNome());
            $this->redirecionar(URL_RAIZ . 'receitas');
        } else {
            $this->setErros(['email' => 'Usuário ou senha inválidos.']);
            $this->visao('login/index.php');
        }

    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        DW3Sessao::deletar('nome-usuario');
        $this->redirecionar(URL_RAIZ . 'home');
    }
}
