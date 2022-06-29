<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Receita extends Modelo
{
    const BUSCAR_ID = 'SELECT * FROM receitas WHERE id = ?';
    const INSERIR = 'INSERT INTO receitas(nome, categoria, ingredientes, modo_de_preparo, data_receita, usuario_id) VALUES ( ?, ?, ?, ?, ?, ?)';
    const DELETAR = 'DELETE FROM receitas WHERE id = ?';
    const BUSCAR_TODOS = 'SELECT r.nome, r.categoria, r.ingredientes, r.modo_de_preparo, r.data_receita, r.id r_id, u.nome u_nome, u.email, u.id u_id FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id)  ORDER BY r.data_receita DESC LIMIT ? OFFSET ?';
    const BUSCAR_TODOS_ASC = 'SELECT r.nome, r.categoria, r.ingredientes, r.modo_de_preparo, r.data_receita, r.id r_id, u.nome u_nome, u.email, u.id u_id FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id)  ORDER BY r.data_receita ASC LIMIT ? OFFSET ?';
    const ATUALIZAR = 'UPDATE receitas SET nome = ?, categoria = ?, ingredientes = ?, modo_de_preparo = ?, data_receita = ? WHERE id = ?';
    const CONTAR_TODAS = 'SELECT count(id) FROM receitas';
    const BUSCAR = 'SELECT * FROM receitas ORDER BY nome';
    const BUSCA = 'SELECT r.nome, r.categoria, r.ingredientes, r.modo_de_preparo, r.data_receita, r.id r_id, u.id u_id, u.email FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id) WHERE TRUE';
    const BUSCAR_RECEITAS_USUARIO = 'SELECT r.nome, r.categoria, r.ingredientes r_ingredientes, r.modo_de_preparo, r.data_receita r_data, u.nome u_nome, r.id r_id, u.id u_id  FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id) WHERE u.id = ? ORDER BY r.data_receita DESC';
    const BUSCAR_INGREDIENTE = 'SELECT r.nome, r.categoria, r.ingredientes, r.modo_de_preparo, r.data_receita, r.id r_id, u.nome u_nome, u.email, u.id u_id FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id) WHERE r.ingredientes LIKE ? ORDER BY r.data_receita DESC LIMIT ? OFFSET ?';
    const BUSCAR_INGREDIENTE_TRUE = 'SELECT r.nome, r.categoria, r.ingredientes, r.modo_de_preparo, r.data_receita, r.id r_id, u.nome u_nome, u.email, u.id u_id FROM receitas r JOIN usuarios u ON (r.usuario_id = u.id) WHERE TRUE';
    
    private $id;
    private $nome;
    private $categoria;
    private $ingredientes;
    private $mododepreparo;
    private $dataReceita;
    private $usuarioId;
    private $usuario;
    private $receita;
    private $foto;


    public function __construct(
        $nome,
        $categoria,
        $ingredientes,
        $mododepreparo,
        $dataReceita,
        $usuarioId,  
        $usuario = null,
        $receita = null,
        $id = null,
        $foto = null
        

    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->ingredientes = $ingredientes;
        $this->mododepreparo = $mododepreparo;
        $this->dataReceita = $dataReceita;
        $this->usuarioId = $usuarioId;
        $this->usuario = $usuario;
        $this->receita = $receita;
        $this->foto = $foto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getReceita()
    {
        return $this->receita;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getNomeReceita()
    {
        return $this->nome;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getModoDePreparo()
    {
        return $this->mododepreparo;
    }

    public function getIngredientes()
    {
        return $this->ingredientes;
    }

    public function getDataReceita()
    {
        return $this->dataReceita;
    }

    public function getDataFormatada()
    {
        $data = date_create($this->dataReceita);
        return date_format($data, 'd/m/Y');
    }

    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'recipe.png';
        }
        return $imagemNome;
    }

    public function setNomeReceita($nome)
    {
        return $this->nome = $nome;
    }

    public function setCategoria($categoria)
    {
        return $this->categoria = $categoria;
    }

    public function setIngredientes($ingredientes)
    {
        return $this->ingredientes = $ingredientes;
    }

    public function setModoDePreparo($mododepreparo)
    {
        return $this->mododepreparo = $mododepreparo;
    }

    public function setDataReceita()
    {
        $this->dataReceita = date('Y-m-d h:i:s');
    }

    public function salvar()
    {
        
        if ($this->id == null) {
            $this->inserir();
            $this->salvarImagem();
        } else {
            $this->atualizar();
            $this->salvarImagem();          
        }
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->categoria, PDO::PARAM_STR);
        $comando->bindValue(3, $this->ingredientes, PDO::PARAM_STR);
        $comando->bindValue(4, $this->mododepreparo, PDO::PARAM_STR);
        $comando->bindValue(5, $this->dataReceita, PDO::PARAM_STR);
        $comando->bindValue(6, $this->usuarioId, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->categoria, PDO::PARAM_STR);
        $comando->bindValue(3, $this->ingredientes, PDO::PARAM_STR);
        $comando->bindValue(4, $this->mododepreparo, PDO::PARAM_STR);
        $comando->bindValue(5, $this->dataReceita, PDO::PARAM_STR);
        $comando->bindValue(6, $this->id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Receita(
            $registro['nome'],
            $registro['categoria'],
            $registro['ingredientes'],
            $registro['modo_de_preparo'],
            $registro['data_receita'],
            $registro['usuario_id'],
            null,
            null,
            $registro['id'],
        );
    }

    public static function buscarTodos($limit = 4, $offset = 0, $orderBy = 'desc')
    {
        if ($orderBy == 'asc') {
            $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_ASC);
        } else {
            $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        }

        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['u_nome'],
                '',
                $registro['u_id']
            );
            $objetos[] = new Receita(
                $registro['nome'],
                $registro['categoria'],
                $registro['ingredientes'],
                $registro['modo_de_preparo'],
                $registro['data_receita'],
                $registro['u_id'],
                $usuario,
                null,
                $registro['r_id']
            );
        }
        return $objetos;
    }

    public static function buscar()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR);
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['email'],
                '',
                $registro['u_id']
            );
            $objetos[] = new Receita(
                $registro['nome'],
                $registro['categoria'],
                $registro['ingredientes'],
                $registro['modo_de_preparo'],
                $registro['data_receita'],
                $registro['u_id'],
                $usuario,
                null,
                $registro['r_id']
            );
        }
        return $objetos;
    }

    public static function buscarReceitasUsuario($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_RECEITAS_USUARIO);
        $objetos = [];
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['u_nome'],
                '',
                '',
                $registro['u_id']
            );
            $objetos[] = new Receita(
                $registro['nome'],
                $registro['categoria'],
                $registro['r_ingredientes'],
                $registro['modo_de_preparo'],
                '',
                $registro['u_id'],
                $usuario,
                null,
                $registro['r_id']
            );
        }
        return $objetos;
    }


    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODAS);
        $total = $registros->fetch();
        return intval($total[0]);
    }


    public static function buscarPorIngrediente($limit = 2, $offset = 0, $busca = '')
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_INGREDIENTE);
        $comando->bindValue(1, "%$busca%", PDO::PARAM_STR);
        $comando->bindValue(2, $limit, PDO::PARAM_INT);
        $comando->bindValue(3, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['u_nome'],
                '',
                $registro['u_id']
            );
            $objetos[] = new Receita(
                $registro['nome'],
                $registro['categoria'],
                $registro['ingredientes'],
                $registro['modo_de_preparo'],
                $registro['data_receita'],
                $registro['u_id'],
                $usuario,
                null,
                $registro['r_id']
            );
        }
        return $objetos;
    }

    //Teste que não deu certo, ainda vou arrumar kkkkkk 

    public static function buscarRegistros($filtro = [])
    {
        $sqlWhere = '';
        $orderBy = 'DESC';
        $parametros = [];
        if (array_key_exists('busca', $filtro) && $filtro['busca'] != '') {
            $parametros[] = $filtro['busca'];
            $sqlWhere .= ' AND r.ingredientes LIKE ?';
        }

        $sql = self::BUSCAR_INGREDIENTE_TRUE . $sqlWhere . ' ORDER BY r.ingredientes' . ' ' . $orderBy;
        $comando = DW3BancoDeDados::prepare($sql);
        foreach ($parametros as $i => $parametro) {
            $comando->bindValue($i + 1, "%$parametro%", PDO::PARAM_STR);
        }
        $comando->execute();
        $registros = $comando->fetchAll();
        return $registros;
    }
    ////

    protected function verificarErros()
    {
        if (strlen($this->nome) < 5) {
            $this->setErroMensagem('nome', 'Mínimo 5 caracteres.');
        }
        if (strlen($this->nome) == null) {
            $this->setErroMensagem('nome', 'Campo não pode ser vazio');
        }
        if (strlen($this->categoria) == '') {
            $this->setErroMensagem('categoria', 'Obrigatório selecionar a categoria');
        }
        if (strlen($this->ingredientes) < 10) {
            $this->setErroMensagem('ingredientes', 'Mínimo 10 caracteres.');
        }
        if (strlen($this->ingredientes) == null) {
            $this->setErroMensagem('ingredientes', 'Campo não pode ser vazio');
        }
        if (strlen($this->mododepreparo) < 10) {
            $this->setErroMensagem('modo_de_preparo', 'Mínimo 10 caracteres.');
        }
        if (strlen($this->mododepreparo) == null) {
            $this->setErroMensagem('modo_de_preparo', 'Campo não pode ser vazio');
        }
    }
}
