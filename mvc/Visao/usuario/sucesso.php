<meta http-equiv="refresh" content="7;URL='<?= URL_RAIZ . 'login' ?>'" />
<main>

    <?php if ($mensagem) : ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?= $mensagem ?>
        </div>
    <?php endif ?>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="success-text">
                    <h1>Seja Bem Vindo(a)</h1>
                    <h4>Redirecionando para login...</h4>
                    <div class="loader"></div>
                </div>
            </div>
        </div>
</main>