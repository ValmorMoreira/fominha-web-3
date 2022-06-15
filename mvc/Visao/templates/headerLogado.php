      <!-- menu -->
      <header id="nav">
        <div class="navbar-fixed">
          <!-- Dropdown  Recipes Structure -->
          <ul id="dropdown1" class="dropdown-content">
            <li><a href="<?= URL_RAIZ . 'receitas' ?>">Ver receitas</a></li>
            <li><a href="<?= URL_RAIZ . 'receitas/cadastrar' ?>">Cadastrar receita</a></li>
          </ul>
          <!-- Fim -> Dropdown  Recipes Structure -->

          <!-- Dropdown  Login Structure -->
          <ul id="dropdownLogin" class="dropdown-content">
            <li><a href="<?= URL_RAIZ . 'usuario/receitas' ?>">Minhas receitas</a></li>
          </ul>
          <!-- Fim -> Dropdown  Login Structure -->

          <nav class="nav-wrapper red darken-4">
            <div class="container">
              <a class="brand-logo" href="<?= URL_RAIZ . 'home' ?>">
                <img style="vertical-align:top;" class="circle my-logo" src="<?= URL_IMG . 'icons/logo.png' ?>">Fominha
              </a>
              <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
              <ul class="right hide-on-med-and-down">
                <li><a href="<?= URL_RAIZ . 'home' ?>">Inicio</a></li>
                <!-- Dropdown Recipes Trigger -->
                <li><a class="dropdown-trigger" href="<?= URL_RAIZ . 'receitas' ?>" data-target="dropdown1">Receitas<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a href="<?= URL_RAIZ . 'relatorio' ?>">Relatórios</a></li>
                <!-- Dropdown Login Trigger -->
                <li>
                  <a class="dropdown-trigger" href="<?= URL_RAIZ . 'home' ?>" data-target="dropdownLogin"> Olá, <?php echo $_SESSION['nome-usuario']; ?> <i class="material-icons right">arrow_drop_down</i></a>
                </li>
                <li>
              <form action="<?= URL_RAIZ . 'login' ?>" method="POST">
                <input type="hidden" name="_metodo" value="DELETE">
                <button id="sair" class="btn-large red darken-4" type="submit"><strong>Sair</strong></button>
              </form>
            </li>
              </ul>
          </nav>
        </div>
        <!-- Dropdown SideNav Structure -->
        <ul id="sidenav" class="dropdown-content">
          <li><a href="<?= URL_RAIZ . 'receitas' ?>">Ver receitas</a></li>
          <li><a href="<?= URL_RAIZ . 'receitas/cadastrar' ?>">Cadastrar receita</a></li>
        </ul>
        <!-- Dropdown  Login Sidenav Structure -->
        <ul id="dropdownLoginSideNav" class="dropdown-content">
          <li><a href="<?= URL_RAIZ . 'usuario/receitas' ?>">Minhas Receitas</a></li>
          <input type="hidden" name="_metodo" value="DELETE">
          <li><a href="<?= URL_RAIZ . 'login' ?>">Sair</a></li>
        </ul>
        <!-- Fim -> Dropdown Sidenav  Login Structure -->
        <ul id="nav-mobile" class="sidenav">
          <!-- Dropdown Login Sidenav Trigger -->
          <li><a class="dropdown-trigger" href="" data-target="dropdownLoginSideNav">Olá, <?php echo $_SESSION['nome-usuario']; ?>  <i class="material-icons right">arrow_right</i></a></li>
          <li><a href="<?= URL_RAIZ . 'home' ?>">Inicio</a></li>
          <!-- Dropdown SideNav Trigger -->
          <li><a class="dropdown-trigger" href="" data-target="sidenav">Receitas<i class="material-icons right">arrow_right</i></a></li>
          <li><a href="<?= URL_RAIZ . 'relatorio' ?>">Relatórios</a></li>
        </ul>
      </header>
      <!-- Fim do menu -->