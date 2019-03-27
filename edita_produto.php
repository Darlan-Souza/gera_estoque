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
    </div>
  </nav>

  <div class="container row m6">
   <h2 class="center title_responsivo">Editar Dados</h2>
   <?php require_once "engine/config.php";
   $Func = new Produto();
   $Func = $Func->Read($_SESSION['id']);
   ?>

   <br><br>
   <div class="row">
     <div class="input-field col m5 s12">
       <input type="text" id="nome_produto" name="nome_produto" value="<?php echo $Func['id']; ?>">
       <label >Nome</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col m5 s12">
       <input type="number" id="quantidade" name="quantidade" value="<?php echo $Func['quantidade']; ?>">
       <label >Quantidade</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col m5 s12">
       <input type="text" id="tipo_produto" name="tipo_produto" value="<?php echo $Func['tipo_produto']; ?>">
       <label >Tipo</label>
     </div>
   </div>
   <br>

   <div class="input-field col m12 s12">
    <p class="center"><a class="waves-effect waves-light btn green darken-3" id="Salvar"><i class="fa fa-pencil"></i> Salvar Alterações </a></p>
  </div>
</div>
</body>
</html>

<script src="js/jquery.js"></script>
<script src="js/materialize.js"></script>

<script type="text/javascript">

  $('#Salvar').click(function(e) {
    e.preventDefault();
    var id = '<?php echo $_SESSION['id']; ?>';
    var nome_produto = $('#nome_produto').val();
    var quantidade = $('#quantidade').val();
    var tipo_produto = $('#tipo_produto').val();

    if (nome_produto === "" || quantidade === "" || tipo_produto === ""){
      var $toastContent = $('<span>Preencha todos os campos!</span>');
      Materialize.toast($toastContent, 4000, 'rounded');
      return;
    }else{
      $.ajax({
        url: 'engine/controllers/produto.php',
        data: {
          id : id,
          nome_produto : nome_produto,
          quantidade : quantidade,
          tipo_produto : tipo_produto,

          action: 'update'
        },
        success: function(data) {
          if(data === 'true'){
            Materialize.toast("Dados Atualizados.", 3000, "rounded", function(){
              window.location.href = "index.php";
            });
          }else{
            var $toastContent = $('<span>Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.</span>');
            Materialize.toast($toastContent, 5000, 'rounded');
          }
        },

        type: 'POST'
      });
    };
  });

</script>