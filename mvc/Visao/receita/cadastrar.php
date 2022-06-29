<!-- formulario -->
<main class="register">
        <div class="">
            <div class="row">
                <div class="card-panel-new">
                    <form action="<?= URL_RAIZ . 'receitas/cadastrar' ?>" method="POST" 
                    enctype="multipart/form-data">
                        <h3>Cadastro de receita</h3>
                        <div class="col s6">
                            <div class="input-field">
                                <i class="material-icons prefix">book</i>
                                <input required="" aria-required="true" name="nome" id="nome" type="text" class="validate " required="required" minlength="5">
                                <label for="nome" data-error="Por favor adicione o nome da receita">Nome da
                                    receita</label>
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="input-field">
                                <i class="material-icons prefix">article</i>
                                <select class="input invalid" required="true" aria-required="true" name="categoria" id="categoria" data-error="Por favor selecione uma categoria">
                                    <option value="bolos">Bolos</option>
                                    <option value="carnes">Carnes</option> 
                                    <option value="massas">Massas</option>                                    
                                    <option value="sobremesas">Sobremesas</option>                                    
                                    <option value="sopas">Sopas</option>
                                    <option value="variedades">Variedades</option>
                                    <option value="vegetariano">Vegetariano</option>
                                    
                                </select>
                                <span class="helper-text" >Por favor selecione uma categoria</span>
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <i class="material-icons prefix">mode_edit</i>
                            <textarea minlength="10" aria-required="true" name="ingredientes" id="ingredientes" class="materialize-textarea"
                                data-error="Favor inserir os ingredientes da receita" required></textarea>
                            <label for="ingredientes">Ingredientes</label>
                        </div>


                        <div class="input-field col s12">
                            <i class="material-icons prefix">toc</i>
                            <textarea minlength="10" aria-required="true" name="modo_de_preparo" id="modo_de_preparo" class="materialize-textarea" data-error="Por favor descreva o modo de preparo." required></textarea>
                            <label for="modo_de_preparo">Modo de preparo</label>
                        </div>

                        <div class="file-field input-field col s6">
                            <div class="btn green darken-2">
                                <span>Carregar imagem</span>
                                <input name="foto" id="foto" type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                                <input type="hidden"  name="data_receita" value="<?= date_create()->format('Y-m-d H:i:s') ?>">
                            </div>
                        </div>
                        <div class="col s6">
                            <p><strong>O envio da imagem é opcional*</strong></p>
                        </div>
                        <button class="btn-large green darken-4 waves-effect waves-light" style="width:100%"
                            type="submit" name="register_recipes">
                            Cadastrar
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </main>
    <!-- fim formulario -->