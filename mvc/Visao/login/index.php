<!-- formulario -->
<main class="login">
    <div class="row">
        <div class="">
            <div class="card-panel-new">
                <form action="<?= URL_RAIZ . 'login' ?>" method="POST">
                    <h3>Login</h3>
                    <div class="input-field invalid">
                        <i class="material-icons prefix">email</i>
                        <input nminlength="8" name="email" id="email" type="email" value="" class="validate " required="required">
                        <label for="email" data-error="E-mail ou senha inválido">E-mail</label>
                        <span class="helper-text" >Por favor inserir um e-mail ou senha válido</span>
                    </div>
                    <div class="input-field invalid">
                        <i class="material-icons prefix">lock</i>
                        <input minlength="5" name="senha" id="senha" type="password" class="validate " required="required">
                        <label for="senha" data-error="E-mail ou senha inválido">Senha</label>
                        <span class="helper-text" >Por favor inserir um e-mail ou senha válido</span>
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