<!--Categorias-->
<main>

    <!--Teste de filtro-->
    <div class="row container">
        <form action="<?= URL_RAIZ . 'receitas' ?>" method="POST" >
            <div class="col s6 ">
                <p class="ordenar-btn">Ordenar a pesquisa</p>
                <div  class="col s3">
                     <button type="submit" class="btn red darken-4" name="ordenar" value="<?= $this->getPost('ordenar') ?>">A - Z</button>           
                </div>
                <div  class="col s3">
                     <button type="submit" class="btn red darken-4" name="ordenar" value="<?= $this->getPost('ordenar') ?>">Z - A</button>           
                </div>
            </form>
            </div>
        <form action="<?= URL_RAIZ . 'receitas' ?>" method="GET">
            <div class="input-field col l6 s6 ">
                <input type="search" autofocus name="busca" value="<?= $this->getGet('busca') ?>" placeholder="Filtrar por ingrediente" id="busca" class="validate autocomplete white invalid" style="padding-left:15px;border: 1px solid rgba(71, 3, 9, 0.5); border-radius: 10px; background: transparent;">
                <button type="submit" class="btn red darken-4" style="position:absolute;top:5px;right:0;padding:0 0.75rem"><i class="material-icons" style="font-size:1.5rem;">search</i></button>
            </div>
        </form>

    </div>
    <!--Fim do teste-->

    <!--Receitas-->
    <div class="container">
        <div class="row">

            <?php if (count($receitas) == 0) : ?>
                <h1 style="text-align:center; margin-top:100px">Sem resultados :(</h1>
            <?php endif ?>

            <?php foreach ($receitas as $receita) : ?>
                <div class="col s4">
                    <div class="card z-depth-2">
                        <div class="card-image">
                            <form method="POST" name="receita">
                                <a href="<?= URL_RAIZ . 'receita/descricao/id=' . $receita->getId() ?>">
                                    <img src="<?= URL_IMG . $receita->getImagem() ?> " alt="Carne de panela com batata">
                                </a>
                            </form>
                        </div>
                        <div class="card-link grey lighten-5" style="padding:8px;">
                            <div style="margin-bottom:5px;line-height:1.2; font-size:20px;">
                                <span><b><?= $receita->getNomeReceita() ?></b></span><br>
                                <i> Categoria: </i><b><?= $receita->getCategoria() ?></b><br>

                                <i> Usuário: </i><?= $receita->getUsuario()->getNome() ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>
            <!--Fim das Receitas-->


        </div>
    </div>


    <!--Paginação-->
    <div class="container">
        <div class="row">
            <div class="col s12 ">
                <div class="col s6">
                    <?php if ($pagina > 1) : ?>
                        <a class="a-pagination" href="<?= URL_RAIZ . 'receitas?p=' . ($pagina - 1) ?>">Página anterior</a>
                    <?php endif ?>
                </div>
                <div class="col s6">
                    <?php if ($pagina < $ultimaPagina) : ?>
                        <a class="a-pagination" href="<?= URL_RAIZ . 'receitas?p=' . ($pagina + 1) ?>">Próxima página</a>
                    <?php endif ?>
                </div>
            </div>
        </div>

    </div>

</main>