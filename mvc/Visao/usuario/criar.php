<main class="register">
        <!-- Formulário de cadastro -->
            <div class="card-panel-new">
                <form id="cadastro" action="<?= URL_RAIZ . 'cadastro' ?>" method="post" >
                    <h3>Cadastro</h3>
                    <p class="red-text col s12 m10 offset-m1"></p>
                    <div class="input-field invalid col s12 m10 offset-m1">
                        <i class="material-icons prefix">account_circle</i>
                        <input  name="nome" id="nome" type="text" required="" aria-required="true">
                        <label for="nome" data-error="Usuário inválido">Usuário</label>
                        <span class="helper-text" data-error="Errado" data-success="Correto">Por favor inserir um nome com mais de 3 caracteres</span>
                    </div>

                    <div class="input-field invalid col s12 m10 offset-m1">
                        <i class="material-icons prefix">mail</i>
                        <input name="email" id="email" type="email" required="required" aria-required="true">
                        <label for="email"  data-error="E-mail inválido...">E-mail</label>
                        <span class="helper-text" data-error="errado" data-success="correto">Um e-mail válido deve seguir este modelo -> seuemail@mail.com </span>
                    </div>
                    <div class="input-field invalid col s12 m10 offset-m1">
                        <i class="material-icons prefix">lock</i>
                        <input minlength="5" name="senha" id="senha" value="" type="password" required="" aria-required="true">
                        <label for="senha" data-error="Senha muito curta">Senha</label>
                        <span class="helper-text" data-error="errado" data-success="correto">A senha deve conter no mínimo 5 dígitos</span>
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