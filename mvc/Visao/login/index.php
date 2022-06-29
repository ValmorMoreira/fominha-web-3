<!-- formulario -->
<main class="login">
    <div class="row">
        <div class="">
            <div class="card-panel-new">
                <form action="<?= URL_RAIZ . 'login' ?>" method="POST">
                    <h3>Login</h3>
                    <div class="input-field  <?= $this->getErroCss('email') ?>">
                        <i class="material-icons prefix">email</i>
                        <input required autofocus  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" id="email" type="email"  value="<?= $this->getPost('email') ?>" class="validate " required="required">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input minlength="5" name="senha" id="senha" type="password" class="validate " required="required">
                
                        <label for="senha">Senha</label>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
                    </div>
                    <button type="submit" name="login_submit" class="btn-large red darken-4 waves-effect waves-light" style="width:100%">Entrar</button>
                    <p>
                        <a href="<?= URL_RAIZ . 'cadastro' ?>" class="left-align">Não tem cadastro? Crie agora.</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- fim formulario -->