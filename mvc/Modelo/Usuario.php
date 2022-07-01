<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_POR_NOME = 'SELECT * FROM usuarios WHERE nome =  ? LIMIT 1';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(nome,email,senha) VALUES (?, ?, ?)';
    const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM usuarios';
    const BUSCAR_TODOS = 'SELECT * FROM usuarios ORDER BY nome';

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $senhaPlana;

    public function __construct(
        $nome = null,
        $email = null,
        $senhaPlana = null,
        $id = null
    ) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senhaPlana = $senhaPlana;
        $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    public function salvar()
    {
        $this->inserir();

        return $this;
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->email, PDO::PARAM_STR);
        $comando->bindValue(3, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Usuario(
            $registro['nome'],
            $registro['email'],
            '',
            $registro['id'],
        );
    }

    public static function buscarEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }

    public static function buscarNome($nome)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_NOME);
        $comando->bindValue(1, $nome, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Usuario(
                
                $registro['nome'], 
                $registro['email'],
                '',
                $registro['id']
            );
        }
        return $objetos;
    }

    protected function verificarErros()
    {
        $emailUsuario = $_POST['email'];        
       
        if (strlen($this->nome) > 9) {
            $this->setErroMensagem('nome', 'Nome muito longo, por favor abreviar.');
        }
        if (strlen($this->nome) < 3) {
            $this->setErroMensagem('nome', 'O nome deve ter no mínimo 3 caracteres.');
        }
        if (strlen($this->nome) == null) {
            $this->setErroMensagem('nome', 'Campo nome não pode ser vazio');
        }
        if (strlen($this->email) == null) {
            $this->setErroMensagem('email', 'Campo e-mail não pode ser vazio');
        }
        if (Usuario::buscarEmail($emailUsuario)) {
            $this->setErroMensagem('email', 'E-mail já cadastrado!');
        }
        if (strlen($this->senhaPlana) < 5) {
            $this->setErroMensagem('senha', 'A senha deve ter no mínimo 5 caracteres.');
        }
        if (strlen($this->senhaPlana) == null) {
            $this->setErroMensagem('senha', 'Campo senha não pode ser vazio');
        }
    }
}
