<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Receita;
use \Framework\DW3BancoDeDados;

class TesteReceita extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('Bastião','teste@example.com', '12345');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeInserir()
    {
        $receita = new Receita('Strogonoff','carnes', 'carne, molho, creme de leite', 'preparar tudo na panela', '2022-06-07', $this->usuarioId);
        $receita->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM receitas WHERE id = " . $receita->getId());
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem['nome'] === $receita->getNomeReceita());
    }

    public function testeBuscarTodos()
    {
        (new Receita('Strogonoff','carnes', 'carne, molho, creme de leite', 'preparar tudo na panela', '2022-06-07', $this->usuarioId))->salvar();
        (new Receita('Strogonoff','carnes', 'carne, molho, creme de leite', 'preparar tudo na panela', '2022-06-07', $this->usuarioId))->salvar();
        $receitas = Receita::buscarTodos();
        $this->verificar(count($receitas) == 3);
    }

    public function testeContarTodos()
    {
        (new Receita('Strogonoff','carnes', 'carne, molho, creme de leite', 'preparar tudo na panela', '2022-06-07', $this->usuarioId))->salvar();
        (new Receita('Strogonoff','carnes', 'carne, molho, creme de leite', 'preparar tudo na panela', '2022-06-07', $this->usuarioId))->salvar();
        $total = Receita::contarTodos();
        $this->verificar($total == 3);
    }

    public function testeDestruir()
    {
        $receita = new Receita('Strogonoff','carnes', 'carne, molho, creme de leite', 'preparar tudo na panela', '2022-06-07', $this->usuarioId);
        $receita->salvar();
        Receita::destruir($receita->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM receitas');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem === false);
    }
}
