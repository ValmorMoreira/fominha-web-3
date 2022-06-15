<!-- formulario -->
<main class="register-recipe">
    <div >
        <div class="row">
            <div class="card-panel-new">
                <form action="<?= URL_RAIZ . 'receitas/editar/' . $receita->getId() ?>" method="POST">
                    <input type="hidden" name="_metodo" value="PATCH">
                    <h3>Editar receita</h3>
                    <div class="col s6">
                        <div class="input-field">
                            <i class="material-icons prefix">book</i>
                            <input autofocus name="nome" id="nome" type="text" class="validate" required="required" value="<?= $receita->getNomeReceita() ?> ">
                            <label for="nome" data-error="Por favor adicione o nome da receita">Nome da
                                receita </label>
                        </div>
                    </div>
                    <div class="col s6">
                        <div class="input-field">
                            <i class="material-icons prefix">article</i>
                            <select class="input invalid" required="true" aria-required="true" name="categoria" id="categoria" data-error="Por favor selecione uma categoria">
                                <option selected value="<?= $receita->getCategoria() ?>"><?= $receita->getCategoria() ?></option>
                            </select>
                            <span class="helper-text">Não é possível alterar a categoria</span>
                        </div>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea name="ingredientes"  class="materialize-textarea" placeholder="Exemplo: 03 Ovos" data-error="Favor inserir os ingredientes da receita" required>
                            <?= $receita->getIngredientes() ?>
                            </textarea>
                        <label for="icon_prefix2">Ingredientes</label>
                    </div>


                    <div class="input-field col s12">
                        <i class="material-icons prefix">toc</i>
                        <textarea name="modo_de_preparo"  class="materialize-textarea" data-error="Por favor descreva o modo de preparo." required>
                                <?= $receita->getModoDePreparo() ?>
                            </textarea>
                        <label for="icon_prefix2">Modo de preparo</label>
                    </div>

                    <div class="row">
                        <div class="file-field input-field col s6">
                            <div class="btn green darken-2">
                                <span>Carregar imagem</span>
                                <input type="file" name="foto">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                        <div class=" col s6">
                            <p><strong>O envio da imagem é opcional*</strong></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s6">
                            <button class="btn-large blue darken-4 waves-effect waves-light modal-close" style="width:100%" type="submit" name="register_recipes">Editar</button>
                        </div>
                        <div class="col s6">
                            <a href="<?= URL_RAIZ . 'usuario/receitas' ?>"><button onclick="alert('Voltando para suas receitas...')" class="btn-large red darken-4 waves-effect waves-light modal-action modal-close" style="width:100%" type="" name="register_recipes">Cancelar</button></a>
                        </div>
                    </div>
            </div>
            </form>
        </div>

    </div>
</main>
<!-- fim formulario -->