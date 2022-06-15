<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],

    '/home' => [
        'GET' => '\Controlador\HomeControlador#index',
    ],

    '/Home' => [
        'GET' => '\Controlador\HomeControlador#index',
    ],

    //Rotas para criação da sessão e login do usuário
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],

    //Rota de cadastro de usuário
    '/cadastro' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],

    //Notificação de sucesso no login
    '/usuario/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],

    //Rota para listagem das receitas do usuário logado
    '/usuario/receitas' => [
        'GET' => '\Controlador\ReceitaControlador#receitasUsuario',
    ],

     //Aqui tem a listagem geral das receitas e o filtro de pesquisa
    '/receitas' => [
        'GET' => '\Controlador\ReceitaControlador#index',
        'POST' => '\Controlador\ReceitaControlador#index',
    ],

    //Direcionamento do usuário da tela de receitas para descrição da receita clicada
    //Também a rota para adicionar comentários.
    '/receita/descricao/id=?' => [
        'GET' => '\Controlador\ReceitaControlador#descricao',
        'POST' => '\Controlador\ComentarioControlador#armazenar',        
    ],

    //Rota para dacastro das receitas
    '/receitas/cadastrar' => [
        'GET' => '\Controlador\ReceitaControlador#criar',
        'POST' => '\Controlador\ReceitaControlador#armazenar',
    ],

    //Rota para acesso ao relatório de usuários receitas e comentários no sistema
    '/relatorio' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],

    '/receitas/editar/?' => [
        'GET' => '\Controlador\ReceitaControlador#editar',
        'PATCH' => '\Controlador\ReceitaControlador#atualizar',
    ],

     '/receitas/deletar/?' => [
        'DELETE' => '\Controlador\ReceitaControlador#destruir',
    ],

    '/receita/comentar' => [
        'POST' => '\Controlador\ComentarioControlador#armazenar',     
    ],

    '/receitas/comentario/deletar/?' => [
        'DELETE' => '\Controlador\ComentarioControlador#destruir',        
    ],
];
