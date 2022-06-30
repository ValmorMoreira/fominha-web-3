<?php
namespace Teste;

use \Modelo\Usuario;
use \Framework\DW3Teste;
use \Framework\DW3Sessao;

class Teste extends DW3Teste
{

	public function logar()
	{
		$usuario = new Usuario('Valmor', 'valmor@teste.com', '12345');		
		$usuario->salvar();		
		DW3Sessao::set('usuario', $usuario->getId());
		DW3Sessao::set('nome-usuario', $usuario->getNome());

		return $usuario;
	}
}
