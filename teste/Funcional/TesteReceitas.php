<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Receita;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteReceitas extends Teste
{
	public function testeListagem()
    {
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'Filtrar por ingrediente');
    }

    public function testeListagemLogado()
    {
        $this->logar();

        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'Filtrar por ingrediente');
    }

    public function testeCriarDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'receitas/cadastrar');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeCriarLogado()
    {
        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'receitas/cadastrar');

        $this->verificarContem($resposta, 'Cadastro de receita');
    }

    public function testeEditarLogado()
    {
        $usuarioLogado = $this->logar();
        $receita = (new Receita('Carne de panela', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuarioLogado->getId()))->salvar();

        $resposta = $this->get(URL_RAIZ . 'receitas/editar/' . $receita->getId() . '?');
        $this->verificarContem($resposta, 'Editar receita');
    }

    public function testeEditarDeslogado()
    {
        $usuarioReceita = (new Usuario('Valmor', 'valmor@teste.com', '12345'))->salvar();
        (new Receita('Carne de panela', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuarioReceita->getId()))->salvar();

        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificar(strpos($resposta['html'], 'Login'));
    }

    public function testeArmazenar()
    {
        $this->logar();

        $resposta = $this->post(URL_RAIZ . 'receitas/cadastrar', [
            'nome' => 'Strogonoff',
            'categoria' => 'carnes',
            'ingredientes' => 'Carne bovina, cebola, alho',
            'modo_de_preparo' => 'colocar tudo no fogo',
            'data_receita' => '2022-06-30 03:20:52'
        ]);

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuario/receitas');
        $resposta = $this->get(URL_RAIZ . 'usuario/receitas');
        $this->verificarContem($resposta, 'Receita cadastrada com sucesso.');

        $query = DW3BancoDeDados::query('SELECT * FROM receitas');
        $bdReceitas = $query->fetchAll();
        $this->verificar(count($bdReceitas) == 1);
    }

    public function testeAtualizar()
    {
        $usuarioLogado = $this->logar();
        $receita = (new Receita('Carne de panela', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-02', $usuarioLogado->getId()))->salvar();

        $resposta = $this->patch(URL_RAIZ . 'receitas/editar/' . $receita->getId(), [
            'nome' => 'Strogonoff',
            'categoria' => 'carnes',
            'ingredientes' => 'Carne bovina, cebola, alho',
            'modo_de_preparo' => 'colocar tudo no fogo',
            'data_receita' => '2022-06-30 03:20:52'
        ]);

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuario/receitas');
        $resposta = $this->get(URL_RAIZ . 'usuario/receitas');
        $this->verificarContem($resposta, 'Receita editada com sucesso.');

        $receitaEditada = Receita::buscarId($receita->getId());
        $this->verificar($receitaEditada->getNomeReceita() == 'Strogonoff');
        $this->verificar($receitaEditada->getIngredientes() == 'Carne bovina, cebola, alho');
        $this->verificar($receitaEditada->getModoDePreparo() == 'colocar tudo no fogo');
    }

    public function testeDestruir()
    {
        $usuarioLogado = $this->logar();
        $receita = (new Receita('Carne de panela', 'carnes', 'carne de gado, molho, tempero', 'colocar tudo na panela', '2022-06-30 03:20:52', $usuarioLogado->getId()))->salvar();

        $deletarReceita = $receita->getId();

        $resposta = $this->delete(URL_RAIZ . 'receitas/deletar/' . $deletarReceita);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuario/receitas');

        $resposta = $this->get(URL_RAIZ . 'usuario/receitas');
        $this->verificarContem($resposta, 'Minhas receitas');

        $receitaDeletada = Receita::buscarTodos();
        $this->verificar(count($receitaDeletada) == 0);
    }
}
