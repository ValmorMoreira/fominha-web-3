<main>

    <?php if ($mensagem) : ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?= $mensagem ?>
        </div>
    <?php endif ?>

    <div class="container" style="margin-top: 25px;">
        <div class="card-panel red darken-4">
            <span class="white-text">
                <h4 style="text-align:center">Minhas receitas </h4>
            </span>
            <div class="row">

                <ul class="collection" id="data">
                    <?php if (count($receitas) == 0) : ?>
                        <li class="collection-item avatar">
                            <h5>Você não possui receitas cadastradas.</h5>
                            <form action="<?= URL_RAIZ . 'receitas/cadastrar' ?> ">
                                <!-- <input type="hidden" name="_metodo" value="PATCH"> -->
                                <button type="submit" style="background-color: transparent; border: none;" class="secondary-content col s3 " data-target="modal_box">
                                    <i class="material-icons" style="font: size 8px;">control_point</i>
                                    <p>Cadastrar</p>
                                </button>
                            </form>
                        </li>
                    <?php endif ?>
                    <?php foreach ($receitas as $receita) : ?>
                        <li class="collection-item avatar">
                            <img src="<?= URL_IMG . 'recipe-icon.png' ?> " class="material-icons circle" />
                            <span class="title"> Título: <?= $receita->getNomeReceita() ?></span>
                            <p> Categoria da receita: <?= $receita->getCategoria() ?></p>
                            <p> Cadastrada em: <?= $receita->getDataFormatada() ?></p>
                            <div class="col s6">
                                <form action="<?= URL_RAIZ . 'receitas/editar/' . $receita->getId() ?> ">
                                    <!-- <input type="hidden" name="_metodo" value="PATCH"> -->
                                    <button type="submit" style="background-color: transparent; border: none;" class="secondary-content col s3 " data-target="modal_box">
                                        <i class="material-icons">edit</i>
                                        <p>Editar</p>
                                    </button>
                                </form>

                                <form action="<?= URL_RAIZ . 'receitas/deletar/' . $receita->getId() ?>" method="post">
                                    <input type="hidden" name="_metodo" value="DELETE">
                                    <button type="submit" style="background-color: transparent; border: none; color:red" class="secondary-content">
                                        <i class="material-icons">delete</i>
                                        <p>Deletar</p>
                                    </button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>

            </div>
        </div>
    </div>
</main>