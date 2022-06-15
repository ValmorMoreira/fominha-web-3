<?php
namespace Controlador;

use Modelo\Comentario;
use \Modelo\Usuario;
use \Modelo\Receita;

class RelatorioControlador extends Controlador
{
    public function index()
    {
        $usuario = $this->getUsuarioSessao();

        $this->visao('relatorios/index.php', [
                'totalDeReceitas' => Receita::contarTodos(),
                'totalDeUsarios' => Usuario::contarTodos(),
                'totalDeComentarios' => Comentario::contarTodos(),
                'usuario' => $usuario,
        ]);
    }
}
