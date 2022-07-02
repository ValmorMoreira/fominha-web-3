<!--Categorias-->
<main>

    <!--Teste de filtro-->
    <div class="container">
        <form action="<?= URL_RAIZ . 'receitas' ?>" method="POST">
            <div class="row">
                <div class="col l6 s6">
                    <?php if ($ordenar == 'desc') : ?>
                       <p class="valign-wrapper"> <button type="submit" class="btn red darken-4" name="ordenar" value="asc">Ordenar por data crescente</button> </p>
                    <?php endif ?>
                    <?php if ($ordenar == 'asc') : ?>
                        <p class="valign-wrapper">  <button type="submit" class="btn red darken-4" name="ordenar" value="desc">Ordenar por data decrescente</button> </p>
                    <?php endif ?>
                </div>

        </form>
        <form action="<?= URL_RAIZ . 'receitas' ?>" method="GET">
            <div class="input-field col l6 s6 ">
                <input type="search" autofocus name="busca" value="<?= $this->getGet('busca') ?>" placeholder="Filtrar por ingrediente" id="busca" class="white" style="padding-left:15px;border: 1px solid rgba(71, 3, 9, 0.5); border-radius: 10px; background: transparent;">
                <button type="submit" class="btn red darken-4" style="position:absolute;top:5px;right:0;padding:0 0.75rem"><i class="material-icons" style="font-size:1.5rem;">search</i></button>
            </div>
        </form>
    </div>
    </div>
    <!--Fim do teste-->

    <!--Receitas-->
    <div class="container">
        <div class="row">

            <?php if (count($receitas) == 0) : ?>
                <h1 class="success-text">Sem receitas no momento...</h1>
            <?php endif ?>

            <?php foreach ($receitas as $receita) : ?>
               
                <form method="POST" name="receita">
                    <div class="col s4">
                        <div class="card z-depth-2">
                            <div class="card-image">
                                <a href="<?= URL_RAIZ . 'receita/descricao/id=' . $receita->getId() ?>">
                                    <img class="list-image" name="foto" src="<?= URL_IMG . $receita->getImagem() ?> ">
                                </a>
                            </div>
                            <div class="card-link grey lighten-5" style="padding:8px;">
                                <div style="margin-bottom:5px;line-height:1.2; font-size:20px;">
                                    <span class="truncate"><b><?= $receita->getNomeReceita() ?></b></span><br>
                                    <i> Categoria: </i><b><?= $receita->getCategoria() ?></b><br>
                                    <i> Por: <?= $receita->getUsuario()->getNome() ?> </i> <br>
                                    <i>Data: <?= $receita->getDataReceita() ?></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            <?php endforeach ?>
            <!--Fim das Receitas-->

        </div>
    </div>

   
<?php if (!$busca) : ?>
    <!--Paginação-->
    <div class="container">
        <div class="row col s12">
            <?php if ($pagina > 1) : ?> 
                <div class="col s6 push-s3">
                    <a class="a-pagination" href="<?= URL_RAIZ . 'receitas?p=' . ($pagina - 1) ?>">Página anterior</a> 
                </div>
            <?php endif ?>
            <?php if ($pagina < $ultimaPagina) : ?>
                <div class="col s6 push-s1">
                       <a class="a-pagination" href="<?= URL_RAIZ . 'receitas?p=' . ($pagina + 1) ?>">Próxima página</a>
                </div>
            <?php endif ?>               
        </div>
    </div>
<?php endif ?>

<?php if($busca): ?>
    <!--Paginação-->
    <div class="container">
        <div class="row col s12">
            <?php if ($pagina > 1) : ?> 
                <div class="col s6 push-s3">
                    <form action="<?= URL_RAIZ . 'receitas?busca=' . $busca . '&p=' . ($pagina - 1) ?>" method="POST">
                        <button type="submit" class="btn red darken-4">Página anterior</a>
                        <input hidden name="busca" value="<?= $busca?>">
                    </form>
                   
                </div>
            <?php endif ?>
            <?php if ($pagina < $ultimaPagina) : ?>
                    <div class="col s6 push-s1">
                        <form action="<?= URL_RAIZ . 'receitas?busca=' . $busca . '&p=' . ($pagina + 1) ?>" method="POST">
                            <button  class="btn red darken-4" type="submit">Próxima página</a>
                            <input hidden name="busca" value="<?= $busca ?>">
                        </form>                       
                    </div>
            <?php endif ?>               
        </div>
    </div>
<?php endif ?>


</main>