<main>
    <?php if ($mensagem) : ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?= $mensagem ?>
        </div>
    <?php endif ?>

    <div class="container">
        <form class="col s12" action="<?= URL_RAIZ . 'receita/descricao/id=' . $receita->getId() ?>" method="post">
            <div class="row" style="background-color: rgba(255, 255, 255, 0.301);">
                <div class="card-panel red darken-4  col s12">
                    <div class="col s6">
                        <span class="white-text">
                            <h4><?= $receita->getNomeReceita() ?></h4>
                            <h5> Categoria: <?= $receita->getCategoria() ?></h5>
                        </span>
                    </div>

                </div>
                <div class="container">
                    <div class="row">
                        <div class="col s6">
                            <img class="materialboxed align-center" width="100%" src="<?= URL_IMG . $receita->getImagem() ?> ">
                        </div>
                        <div class="col s6">
                            <div class="card-panel red darken-4">
                                <span class="white-text">
                                    <h4>Ingredientes</h4>
                                    <p><?= $receita->getIngredientes() ?></p>
                                    <div class="divider"></div>
                                    <h4>Modo de preparo</h4>
                                    <p><?= $receita->getModoDePreparo() ?></p>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col s12">
                    <div class="card-panel red darken-4">
                        <span class="white-text">
                            <h4 style="text-align:center">Comentários</h4>
                        </span>

                        <form name="comentarios" class="col s12" action="<?= URL_RAIZ . 'receitas/comentar' ?>" method="POST">
                            <div class="row">
                                <div class="col s10 <?= $this->getErroCss('comentario') ?>">
                                    <input value="<?= $this->getPost('comentario') ?>" placeholder="Ex: Gostei muito dessa receita..." name="comentario" id="comentario" type="text" class="validate autocomplete white invalid" style="padding-left:15px;border: 1px solid rgba(71, 3, 9, 0.5); border-radius: 10px; background: transparent;">
                                </div>
                                
                                <input type="hidden" class="form-control" id="nome" name="data_comentario" value="<?= date_create()->format('Y-m-d H:i:s') ?>">
                                <div class="col s2">
                                    <button type="submit" class="btn green darken-4 waves-effect waves-light" width="100%" type="submit">
                                        Comentar
                                    </button>                                    
                                </div>
                                
                            </div>
                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'comentario']) ?>
                        </form>

                        <ul class="collection">
                            <?php foreach ($comentarios as $comentario) : ?>
                                <li class="collection-item avatar">
                                    <img src="<?= URL_IMG . 'padrao.png' ?> " class="material-icons circle" />
                                    <span class="title"> <?= $comentario->getUsuario()->getNome() ?> </span>
                                    <h5> <?= $comentario->getComentario() ?> </h5>
                                    <p>Comentado em: <?= $comentario->getDataFormatada() ?> </p>
                                    <?php if ($this->getUsuario() == $comentario->getUsuarioId()) : ?>
                                        <form action="<?= URL_RAIZ . 'receitas/comentario/deletar/' . $comentario->getId() ?> " method="POST">
                                            <input type="hidden" name="_metodo" value="DELETE">
                                            <button type="submit" style="background-color: transparent; border: none; color:red" onclick="alert('comentário deletado com sucesso!')" class="secondary-content">
                                                <i class="material-icons">delete</i>
                                                <p>Deletar</p>
                                            </button>
                                        </form>

                                </li>
                            <?php endif ?>
                        <?php endforeach ?>

                        </ul>
                    </div>
                </div>

            </div>

    </div>
    </div>
</main>