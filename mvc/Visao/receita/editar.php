<!-- formulario -->
<main class="register-recipe">
    <div >
        <div class="row">
            <div class="card-panel-new">
                <form action="<?= URL_RAIZ . 'receitas/editar/' . $receita->getId() ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_metodo" value="PATCH">
                    <h3>Editar receita</h3>
                    <div class="col s6">
                        <div class="input-field <?= $this->getErroCss('nome') ?>">
                            <i class="material-icons prefix">book</i>
                            <input autofocus name="nome" id="nome" type="text"  value="<?= $receita->getNomeReceita() ?> ">
                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
                            <label for="nome">Nome da receita </label>
                        </div>
                    </div>
                    <div class="col s6">
                        <div class="input-field <?= $this->getErroCss('categoria') ?>">
                            <i class="material-icons prefix">article</i>
                            <select class="input" name="categoria" id="categoria">
                                <option selected value="<?= $receita->getCategoria() ?>"><?= $receita->getCategoria() ?></option>
                                    <option value="<?= $this->getPost('categoria') ?>"><?= $this->getPost('categoria') ?></option>
                                    <option value="bolos">Bolos</option>
                                    <option value="carnes">Carnes</option> 
                                    <option value="massas">Massas</option>                                    
                                    <option value="sobremesas">Sobremesas</option>                                    
                                    <option value="sopas">Sopas</option>
                                    <option value="variedades">Variedades</option>
                                    <option value="vegetariano">Vegetariano</option>                                    
                            </select>
                            <label for="categoria">Categoria</label>  
                        </div>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'categoria']) ?>
                    </div>

                    <div class="input-field col s12 <?= $this->getErroCss('ingredientes') ?>">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea name="ingredientes"  class="materialize-textarea"><?= $receita->getIngredientes() ?></textarea>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'ingredientes']) ?>
                        <label for="icon_prefix2">Ingredientes</label>
                    </div>


                    <div class="input-field col s12 <?= $this->getErroCss('modo_de_preparo') ?>">
                        <i class="material-icons prefix">toc</i>
                        <textarea name="modo_de_preparo"  class="materialize-textarea"><?= $receita->getModoDePreparo() ?></textarea>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'modo_de_preparo']) ?>
                        <label for="icon_prefix2">Modo de preparo</label>
                    </div>

                    <div class="row">
                        <div class="file-field input-field col s6">
                            <div class="btn green darken-2">
                                <span>Imagem selecionada</span>
                                <input disabled type="file" name="foto">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" value="<?= $receita->getImagem() ?>" >
                                <input type="hidden"  name="data_receita" value="<?= date_create()->format('Y-m-d H:i:s') ?>">
                            </div>
                        </div>
                        <div class=" col s6">
                            <p><strong>Não é possível atualizar a imagem*</strong></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <button class="btn-large blue darken-4 waves-effect waves-light modal-close" style="width:100%" type="submit" name="register_recipes">Editar</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>

    </div>
</main>
<!-- fim formulario -->