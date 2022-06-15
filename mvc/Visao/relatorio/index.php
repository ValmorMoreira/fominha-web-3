<main>
        <div class="home-text">
            <div class="container white">
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">people</i>Total de usuários</div>
                        <div class="collapsible-body">
                            <h3>
                                Usuários no sistema: <?= $usuarios ?>
                            </h3>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">book</i>Total de receitas</div>
                        <div class="collapsible-body">
                            <h3> Receitas cadastradas: <?= $receitas ?></h3>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">message</i>Total de Comentários</div>
                        <div class="collapsible-body">
                            <h3> Comentários cadastrados: <?= $comentarios ?></h3>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </main>