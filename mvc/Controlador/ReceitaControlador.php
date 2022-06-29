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
        $usuario = $this->getUsuarioSessao();

        $sqlQuery = empty($_GET['busca']) ? null : $_GET['busca'];
        $orderBy = empty($_POST['ordenar']) ? 'desc' : $_POST['ordenar'];       
        

        if ($sqlQuery) {
            $paginacao = $this->calcularPaginacao("buscarPorIngrediente", "contarTodos",  $orderBy, $sqlQuery);
        }else{
            $paginacao = $this->calcularPaginacao("buscarTodos", "contarTodos", $orderBy);
        }

        $this->visao('receita/index.php', [
            'mensagem' => DW3Sessao::getFlash('mensagem'),
            'receitas' => $paginacao['receitas'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'busca' => $sqlQuery,
            'ordenar' => $orderBy,
            'usuario' => $usuario
            ]);
    }

    public function criar()
    {    
        $this->verificarLogado();
        $this->visao('receita/cadastrar.php', [
            'receitas' => Receita::buscarTodos(),
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
            null,
            null,
            null,
            $foto
        );

        if ($receita->isValido()) {
            $receita->salvar();
            DW3Sessao::setFlash('mensagem', 'Receita cadastrada com sucesso.');
            $this->redirecionar(URL_RAIZ . 'usuario/receitas');
        } else {
            $this->setErros($receita->getValidacaoErros());
            $this->visao('receita/cadastrar.php');
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
        $usuario = $this->getUsuarioSessao();

        $receita->setNomeReceita($_POST['nome']);
        $receita->setCategoria($_POST['categoria']);
        $receita->setIngredientes($_POST['ingredientes']);
        $receita->setModoDePreparo($_POST['modo_de_preparo']);
        $receita->setDataReceita($_POST['data_receita']);

        if ($receita->isValido()) {
            $receita->salvar();
            DW3Sessao::setFlash('mensagem', 'Receita editada com sucesso.');
            $this->redirecionar(URL_RAIZ . 'usuario/receitas');
        }else {
            $this->setErros($receita->getValidacaoErros());
            $this->visao('receita/editar.php', [
                'usuario' => $usuario,
                'receita' => $receita
            ]);
        }        
    }

    public function descricao($id)
    {
        $receitaValida = Receita::buscarId($id);
         if($receitaValida->getId() != null){
            $this->visao('receita/descricao.php', [
                'receita'=> Receita::buscarId($id),
                'comentarios' => Comentario::buscarTodasPorId($id),
                'mensagem' => DW3Sessao::getFlash('mensagem')  
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
            'mensagem' => DW3Sessao::getFlash('mensagem'),
        ]);  
    } 

    public function destruir($id)
    {
        $this->verificarLogado();
        $receita = Receita::buscarId($id);

        if ($receita->getUsuarioId() == $this->getUsuario()) {
            Receita::destruir($id);
            DW3Sessao::setFlash('mensagem', 'Receita deletada com sucesso.');
            $this->redirecionar(URL_RAIZ . 'usuario/receitas');
        } else {
            $this->redirecionar(URL_RAIZ . 'home');
            DW3Sessao::setFlash('mensagem', 'Erro, receita não localizada.');
        }
    } 

}
