<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Receita;
use \Modelo\Comentario;
use \Framework\DW3BancoDeDados;

class TesteComentario extends Teste
{
	public function testeArmazenar()
    {
		$usuarioLogado = $this->logar();
		$receita = (new Receita('Carne de panela', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuarioLogado->getId()))->salvar();
        
		$this->post(URL_RAIZ . '/receita/descricao/id=' . $receita->getId(), [
            'comentario' => 'vaaaaaaaaaaaaamos!',
            $receita->getId(),
            $usuarioLogado->getId(),
        ]);

        $query = DW3BancoDeDados::query('SELECT * FROM comentarios WHERE comentario = "vaaaaaaaaaaaaamos!" and receita_id = ' . $receita->getId());
        $bdComentarios = $query->fetchAll();
        $this->verificar(count($bdComentarios) == 0);
    }

   public function testeDestruir()
    {
        $usuarioLogado = $this->logar();
		$receita = (new Receita('Carne de panela', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuarioLogado->getId()))->salvar();
		$comentario = (new Comentario('Ficou uma delicia', $receita->getId(), $usuarioLogado->getId()))->salvar();

        $this->delete(URL_RAIZ . 'receitas/comentario/deletar/' . $comentario->getId());


        $comentarioEditada = Comentario::buscarId($comentario->getId());
        $this->verificar($comentarioEditada == null);
    }
}
