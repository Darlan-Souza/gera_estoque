<?php
$showerros = true;
if($showerros) {
  ini_set("display_errors", $showerros);
  error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}

session_start();
// Inicia a sessão

if(empty($_SESSION)){
  ?>
  <script>
    document.location.href = 'login.php' ;
  </script>
  <?php
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Estoque</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav>
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo"><i class="material-icons">cloud</i>Estoque</a>
      <ul class="right hide-on-med-and-down" id="sair">
        <li><a href="engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
      </ul>
      <a href="usuario/editar.php" class="right hide-on-med-and-down "><i class="large material-icons">account_circle</i>Usuário</a>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col s12 m6">
        <div class="card blue-grey darken-1">
          <div class="card-content white-text">
            <span class="card-title">Deposito</span>
            <p>Insira no sistema os produtos que você adquiriu.</p>
          </div>
          <div class="card-action">
            <a href="produto/inserir_produto.php">Inserir</a>
          </div>
        </div>
      </div>
      <div class="col s12 m6">
        <div class="card blue-grey darken-1">
          <div class="card-content white-text">
            <span class="card-title">Consultar</span>
            <p>Consulte no sistema os produtos que você possui.</p>
          </div>
          <div class="card-action">
            <a href="produto/consultar_produto.php">Consultar</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>

</body>
</html>

<script>
  $('.sair').click(function(e) {
      e.preventDefault();

      $.ajax({
        url: 'engine/controllers/logout.php',
        data: {},
        success: function(data) {
          if(data === 'kickme'){
            document.location.href = 'engine/controllers/login.php';
          } else {
            alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
          }
        },
        type: 'POST'
      });
    });
</script>
