<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Comentario extends Modelo
{

    const BUSCAR_ID = 'SELECT * FROM comentarios WHERE id = ? LIMIT 1';
    const INSERIR = 'INSERT INTO comentarios ( comentario, receita_id, usuario_id, data_comentario ) VALUES (?, ?, ?, ?)';
    const DELETAR = 'DELETE FROM comentarios WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM comentarios';
    const BUSCAR_POR_ID_RECEITA = 'SELECT * FROM comentarios WHERE receita_id = ? order by data_comentario ASC';
 
    private $id;
    private $comentario;
    private $receitaId;
    private $usuarioId;    
    private $dataComentario;   

    public function __construct(
        $comentario,
        $receitaId,
        $usuarioId,
        $id = null,
        $dataComentario = null
        ) {
        $this->id = $id;
        $this->comentario = $comentario;
        $this->receitaId = $receitaId;
        $this->usuarioId = $usuarioId;
        $this->dataComentario = $dataComentario;
    }

    public function getid()
    {
        return $this->id;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getReceitaId()
    {
        return $this->receitaId;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getDataFormatada()
    {
        $date = date_create($this->dataComentario);
        return date_format($date, 'd/m/Y H:i:s');
    }

    public function getUsuario()
    {
        return Usuario::buscarId($this->getUsuarioId());
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
        $comando->bindValue(1, $this->comentario);
        $comando->bindValue(2, $this->receitaId);
        $comando->bindValue(3, $this->usuarioId);
        $comando->bindValue(4, $this->dataComentario);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id,  PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();

        if($registro) {
            return new Comentario(
            $registro['comentario'],
            $registro['receita_id'],
            $registro['usuario_id'],
            $registro['id'],
            $registro['data_comentario'],
            );
        }

        return null;
    }


    public static function buscarTodasPorId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_ID_RECEITA);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $comentarios = [];
        foreach ($registros as $registro) {
            $comentarios[] = new Comentario(
                $registro['comentario'],
                $registro['receita_id'],
                $registro['usuario_id'],
                $registro['id'],
                $registro['data_comentario'],
                );
        }
        return $comentarios;
    }

       
    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    protected function verificarErros()
    {
        if (strlen($this->comentario) < 10) {
            $this->setErroMensagem('comentario', 'Campo comentário precisa ter no mínimo 10 caracteres.');
        }
    }
}
