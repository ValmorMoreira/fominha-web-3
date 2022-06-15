<?php

namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;


class UsuarioControlador extends Controlador
{
    

    public function criar()
    {
        $this->visao('usuario/criar.php', [
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ]);
    }

    public function armazenar()
    {
        $usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);
        
        if ($usuario->isValido()) {
            $usuario->salvar();
            $this->redirecionar(URL_RAIZ . 'usuario/sucesso');
            DW3Sessao::setFlash('mensagem', 'Usuário Cadastrado com sucesso.');
        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuario/criar.php');
        }
    }

    public function sucesso()
    {
        $this->visao('/usuario/sucesso.php',[
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ]);
    }

}
