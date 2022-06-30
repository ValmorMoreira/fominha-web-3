<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Receita;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteReceita extends Teste
{
    public function testeInserir()
    {
        $receita = $this->criarReceita();
        
        $query = DW3BancoDeDados::query('SELECT * FROM receitas WHERE id = ' . $receita->getId());
        $comentariosBanco = $query->fetchAll();
        $this->verificar(count($comentariosBanco) == 1);
    }

    public function testeAtualizar()
    {
        $receita = $this->criarReceita();

        $receita->setNomeReceita("Carne de panela");
        $receita->salvar();

        $query = DW3BancoDeDados::query('SELECT * FROM receitas WHERE id = ' . $receita->getId());
        $receitaBanco = $query->fetch();
        $this->verificar($receitaBanco['nome'] == "Carne de panela");
    }

    public function testeDestruir()
    {
        $receita = $this->criarReceita();
        Receita::destruir($receita->getId());
        
        $query = DW3BancoDeDados::query('SELECT * FROM receitas WHERE id = ' . $receita->getId());
        $receitaBanco = $query->fetchAll();

        $this->verificar(count($receitaBanco) == 0);
    }

    public function testeBuscarTodos()
    {
        $this->criarReceita();

        $receitas = Receita::buscarTodos();
        $this->verificar(count($receitas) == 1);
    }
    

    public function testeContarTodos()
    {
        $usuario = (new Usuario('Valmor', 'valmor@teste.com', '12345'))->salvar();
        (new Receita('Carne de panela', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuario->getId()))->salvar();
        (new Receita('Carne de urso', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuario->getId()))->salvar();
        (new Receita('Carne de gado', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuario->getId()))->salvar();
        (new Receita('Carne de peixe', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuario->getId()))->salvar();
        
        $quantidadeDeReceitas = Receita::contarTodos();
        $this->verificar($quantidadeDeReceitas == 4);
    }

    public function testeBuscarId()
    {
        $receita = $this->criarReceita();
        $receitaBusca = Receita::buscarId($receita->getId());

        $this->verificar($receita->getId() == $receitaBusca->getId());
    }

    public function testeBuscarPorQuery()
    {
        $this->criarReceita();

        $receitas = Receita::buscarPorIngrediente(2, 0, 'carne de gado, molho, tempero');
        $this->verificar(count($receitas) == 1);
    }

    private function criarReceita() 
    {
        $usuarioLogado = $this->logar();
        $receita = (new Receita('Carne de panela', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuarioLogado->getId()))->salvar();

        return $receita;
    }
}
