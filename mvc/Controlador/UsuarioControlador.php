<?php

namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;


class UsuarioControlador extends Controlador
{    

    public function criar()
    {

        $usuario = $this->getUsuarioSessao();
        
        $this->visao('usuario/criar.php',[
            'usuario' => $usuario,
        ]);
    }

    public function armazenar()
    {
        
        $usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);

        if ($usuario->isValido()) {           
            $usuario->salvar();
            DW3Sessao::setFlash('mensagem', 'Usuário Cadastrado com sucesso.');
            $this->redirecionar(URL_RAIZ . 'usuario/sucesso');                                        
        }
            
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuario/criar.php',[
                'usuario' => $usuario,
            ]);

    }

    public function sucesso()
    {
        if(DW3Sessao::get('usuario')){
            $this->redirecionar(URL_RAIZ . 'receitas');
        }
        $this->visao('/usuario/sucesso.php',[
            'mensagem' => DW3Sessao::getFlash('mensagem')
        ]);
    }

}
