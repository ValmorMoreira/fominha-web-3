<?php
namespace Controlador;

use \Modelo\Comentario;
use \Modelo\Receita;
use \Framework\DW3Sessao;

class ComentarioControlador extends Controlador
{
    public function armazenar($receitaId)
    {
       $this->verificarLogado();

        $comentario = new Comentario(
                $_POST['comentario'],
                $receitaId,
                DW3Sessao::get('usuario'),
            );

        if ($comentario->isValido()) {
            $comentario->salvar();
            DW3Sessao::setFlash('mensagem', 'Comentário cadastrado com sucesso!');
            $this->redirecionar(URL_RAIZ . 'receita/descricao/id=' . $receitaId);
        } else {
            DW3Sessao::setFlash('mensagem', 'O comentário não foi cadastrado!');
            $this->setErros($comentario->getValidacaoErros());            
            //$this->redirecionar(URL_RAIZ . 'receita/descricao/id=' . $receitaId);
            $usuario =  DW3Sessao::get('usuario');
            $receita = Receita::buscarId($receitaId);
            $comentarios = Comentario::buscarTodasPorId($receita->getId());

            $this->visao('receita/descricao.php',[
                'usuario' => $usuario,
                'receita' => $receita,
                'comentarios' => $comentarios,
                'mensagem' => DW3Sessao::getFlash('mensagem')
            ]);
            
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();

        //$usuario = $this->getUsuarioSessao();
        $comentario = Comentario::buscarId($id);
        $receitaId = $comentario->getReceitaId();

        // if($usuario && $usuario->getId() == $comentario->getUsuarioId()) {
        //     return $this->redirecionar(URL_RAIZ . 'receitas');
        // }

        Comentario::destruir($id);
        $comentario = Comentario::buscarId($id);

        if($comentario) {
            DW3Sessao::setFlash('mensagem', 'Houve um erro ao deletar seu comentário!');
            $this->redirecionar(URL_RAIZ . 'receita/descricao/id=' . $receitaId);
        } else {
            DW3Sessao::setFlash('mensagem', 'Comentário deletado com sucesso!');
            $this->redirecionar(URL_RAIZ . 'receita/descricao/id=' . $receitaId);
        }
    }
}