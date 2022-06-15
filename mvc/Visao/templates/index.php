<!DOCTYPE html>
<html>

<head>
  <title><?= APLICACAO_NOME ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="<?= URL_IMG . 'icons/favicon.ico' ?>">
  <!-- CSS  -->
  <link rel="stylesheet" href="<?= URL_CSS . 'materialize.css' ?>">
  <link rel="stylesheet" href="<?= URL_CSS . 'personalStyle.css' ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>

  <!-- menu -->
  <?php
  use \Framework\DW3Sessao;
    if (DW3Sessao::get('usuario')) {
      require_once 'headerLogado.php';
    } else {
      include_once 'headerLogin.php';
    }
  ?>
  <!-- Fim do menu -->

  <?php $this->imprimirConteudo() ?>

  <!-- Início Rodapé -->
  <footer class="page-footer red darken-4">
    <div class="footer-copyright red darken-4">
      <div class="container">
        Desenvolvido por <a class="white-text text-lighten-3" target="_blank" href="https://github.com/ValmorMoreira">Valmor Moreira</a>
      </div>
    </div>
  </footer>
  <!-- Final do Rodapé -->

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="<?= URL_JS . 'materialize.js' ?>"></script>
   <!-- JS Customizados -->
   <script src="<?= URL_JS . 'scripts.js' ?>"></script>
   <script src="<?= URL_JS . 'onLoadScripts.js' ?>"></script>
</body>

</html>