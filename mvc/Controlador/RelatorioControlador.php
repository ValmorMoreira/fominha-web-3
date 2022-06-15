<?php
namespace Controlador;

use Modelo\Comentario;
use \Modelo\Usuario;
use \Modelo\Receita;

class RelatorioControlador extends Controlador
{
    public function index()
    {
        $this->visao('relatorio/index.php', [
            'usuarios' => Usuario::contarTodos(),
            'receitas' => Receita::contarTodos(),
            'comentarios' => Comentario::contarTodos(),
        ]);
    }
}