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
   $Func = new Usuario();
   $Func = $Func->Read($_SESSION['id']);
   ?>

   <br><br>
   <div class="row">
     <div class="input-field col m5 s12">
       <input type="text" id="nome" name="nome" value="<?php echo $Func['nome']; ?>">
       <label >Nome</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col m5 s12">
       <input type="text" id="cpf" name="cpf" value="<?php echo $Func['cpf']; ?>">
       <label >CPF</label>
     </div>
   </div>
   <div class="row">
     <div class="input-field col m5 s12">
       <input type="email" id="email" name="email" required class="validate" value="<?php echo $Func['email']; ?>">
       <label >E-mail</label>
     </div>
   </div>
   <br>

   <div class="input-field col m12 s12">
    <p class="center"><a class="waves-effect waves-light btn green darken-3" id="Salvar"><i class="fa fa-pencil"></i> Salvar Alterações </a></p>
  </div>
</div>

<footer class="footer-adm">
</footer>

<script src="../js/jquery.js"></script>
<script src="../js/jquerymask.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/drop_materialize.js"></script>
<script src="../js/timer.js"></script>
<script src="../js/mbox-0.0.1.js"></script>
<script src="../js/toastr.min.js"></script>

</body>
</html>

<script src="js/jquery.js"></script>
<script src="js/materialize.js"></script>
<script type="text/javascript">

  $('#Salvar').click(function(e) {
    e.preventDefault();
    var id = '<?php echo $_SESSION['id']; ?>';
    var nome = $('#nome').val();
    var cpf = $('#cpf').val();
    var email = $('#email').val();

    if (nome === "" || cpf === "" || email === ""){
      var $toastContent = $('<span>Preencha todos os campos!</span>');
      Materialize.toast($toastContent, 4000, 'rounded');
      return;
    }else{
      $.ajax({
        url: 'engine/controllers/usuario.php',
        data: {
          id : id,
          nome : nome,
          cpf : cpf,
          email : email,

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