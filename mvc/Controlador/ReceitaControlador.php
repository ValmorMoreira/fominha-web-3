<?php

namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Receita;
use \Modelo\Comentario;

class ReceitaControlador extends Controlador
{

    public function optionDinamico(){

        $opcao = '';

        switch($opcao){
            case 1 : $opcao = 'Bolos';
            break;
            case 2 : $opcao = 'Carnes';
            break;
            case 3 : $opcao = 'Doces';
            break;
            case 4 : $opcao = 'Massas';
            break;
            case 5 : $opcao = 'Sobremesas';
            break;
            case 6 : $opcao = 'Variedades';
            break;
            default: $opcao = null;
        }

        return $opcao;
    }
  
    public function index()
    {
        $sqlQuery = empty($_GET['busca']) ? null : $_GET['busca'];
        $orderBy = empty($_GET['ordenar']) ? 'asc' : $_GET['ordenar'];

        $paginacao = $this->calcularPaginacao("buscarTodos", "contarTodos", $orderBy);

        if ($sqlQuery) {
            $paginacao = $this->calcularPaginacao("buscarPorIngrediente", "contarTodos", $sqlQuery);
        }

        $this->visao('receita/index.php', [
            'mensagem' => DW3Sessao::getFlash('mensagem'),
            'receitas' => $paginacao['receitas'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'busca' => $sqlQuery,
            'ordenar' => $orderBy,
            ]);
    }

    public function criar()
    {    
        $this->verificarLogado();
        $this->visao('receita/cadastrar.php', [
            'receitas' => Receita::buscarTodos(),
            'mensagem' =>  DW3Sessao::getFlash('mensagemFlash')
        ]);  
    }

       public function armazenar()
    {

        $this->verificarLogado();
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $receita = new Receita(
            $_POST['nome'],
            $_POST['categoria'],
            $_POST['ingredientes'],
            $_POST['modo_de_preparo'],
            $_POST['data_receita'],
            DW3Sessao::get('usuario'),
            $foto
        );

        if ($receita->isValido()) {
            $receita->salvar();
            DW3Sessao::setFlash('mensagem', 'Receita cadastrada com sucesso');
            $this->redirecionar(URL_RAIZ . 'usuario/receitas');
        } else {
            $this->setErros($receita->getValidacaoErros());
            $this->visao('receita/criar.php');
        }
    }

    public function editar($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);
        
        if ($receita->getUsuarioId() == $this->getUsuario()) {
            $this->visao('receita/editar.php', [
                'receita' => $receita
            ]);            
        }       
    }

    public function atualizar($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);
        $receita->setNomeReceita($_POST['nome']);
        $receita->setCategoria($_POST['categoria']);
        $receita->setIngredientes($_POST['ingredientes']);
        $receita->setModoDePreparo($_POST['modo_de_preparo']);
        $receita->setDataReceita($_POST['data_receita']);
        $receita->salvar();
        DW3Sessao::setFlash('mensagemFlash', 'Receita Atualizada com sucesso.');
        $this->redirecionar(URL_RAIZ . 'usuario/receitas');
    }

    public function descricao($id)
    {
        $receitaValida = Receita::buscarId($id);
         if($receitaValida->getId() != null){
            $this->visao('receita/descricao.php', [
                'receita'=> Receita::buscarId($id),
                'comentarios' => Comentario::buscarTodasPorId($id),   
            ]); 
        }else{
            $this->redirecionar(URL_RAIZ . 'receitas');
        }
        
    }

    public function receitasUsuario()
    {
        $this->verificarLogado();
        $usuario = $this->getUsuario();
        $this->visao('usuario/receitas.php', [
            'receitas' => Receita::buscarReceitasUsuario($usuario),
             DW3Sessao::getFlash('mensagem', null),
        ]);  
    } 

    public function destruir($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);

        if ($receita->getUsuarioId() == $this->getUsuario()) {
            Receita::destruir($id);
            DW3Sessao::setFlash('mensagem', 'Receita destruida.');
            $this->redirecionar(URL_RAIZ . 'usuario/receitas');
        } else {
            $this->redirecionar(URL_RAIZ . 'home');
            DW3Sessao::setFlash('mensagem', 'Erro, receita não localizada.');
        }
    } 

}
