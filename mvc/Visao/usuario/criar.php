<main class="register">
        <!-- Formulário de cadastro -->
            <div class="card-panel-new">
                <form id="cadastro" action="<?= URL_RAIZ . 'cadastro' ?>" method="post" >
                    <h3>Cadastro</h3>
                    <div class="input-field invalid col s12 m10 offset-m1 <?= $this->getErroCss('nome') ?>">
                        <i class="material-icons prefix">account_circle</i>
                        <input  name="nome" id="nome" type="text"  value="<?= $this->getPost('nome') ?>">
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
                        <label for="nome">Usuário</label>
                    </div>

                    <div class="input-field invalid col s12 m10 offset-m1 <?= $this->getErroCss('email') ?>">
                        <i class="material-icons prefix">mail</i>
                        <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" id="email" type="email"  value="<?= $this->getPost('email') ?>">
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
                        <label for="email">E-mail</label>
                    </div>
                    <div class="input-field invalid col s12 m10 offset-m1 <?= $this->getErroCss('senha') ?>">
                        <i class="material-icons prefix">lock</i>
                        <input  name="senha" id="senha" value="" type="password" >
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'senha']) ?>
                        <label for="senha" data-error="Senha muito curta">Senha</label>
                    </div>
                    <div class="center-align">
                        <button id="submitButton" name="reg_submit" type="submit" class="btn-large red darken-4 waves-effect waves-light"
                            style="width:90%;">Cadastrar</button>
                    </div>
                    <p class="center-align">
                        <a href="<?= URL_RAIZ . 'login' ?>">Já tem cadastro? Faça o login aqui.</a>
                    </p>
                </form>
            </div>
            <!-- Fim do formulário -->
    </main>