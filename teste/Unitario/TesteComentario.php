<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Comentario;
use \Modelo\Receita;
use \Framework\DW3BancoDeDados;

class TesteComentario extends Teste
{
    public function testeInserir()
    {
        $comentario = $this->criarComentario();
        
        $query = DW3BancoDeDados::query('SELECT * FROM comentarios WHERE id = ' . $comentario->getId());
        $bdComentarios = $query->fetchAll();
        $this->verificar(count($bdComentarios) == 1);
    }

    public function testeDestruir()
    {
        $comentario = $this->criarComentario();
        Comentario::destruir($comentario->getId());
        
        $query = DW3BancoDeDados::query('SELECT * FROM comentarios WHERE id = ' . $comentario->getId());
        $bdComentarios = $query->fetchAll();

        $this->verificar(count($bdComentarios) == 0);
    }

    public function testeBuscarId()
    {
        $comentario = $this->criarComentario();
        $comentarioBusca = Comentario::buscarId($comentario->getId());

        $this->verificar($comentario->getId() == $comentarioBusca->getId());
    }

    public function testeBuscarPorReceitaId()
    {
        $comentario = $this->criarComentario();
        $comentariosPorReceita = Comentario::buscarTodasPorId($comentario->getReceitaId());

        $this->verificar(count($comentariosPorReceita) == 1);
    }

    private function criarComentario() 
    {
        $usuarioLogado = $this->logar();
		$receita = (new Receita('Carne de panela', 'carnes', 'carne de gado, molho, tempero', 'colocar no fogo', '2022-06-30 03:20:52', $usuarioLogado->getId()))->salvar();
		$comentario = (new Comentario('Esta receita é muito top!', $receita->getId(), $usuarioLogado->getId()))->salvar();

        return $comentario;
    }
}
