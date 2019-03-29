<?php
$showerros = true;
if($showerros) {
  ini_set("display_errors", $showerros);
  error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}
session_start();
// Inicia a sessão

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Estoque</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style_registro.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>  
  <nav>
    <div class="nav-wrapper">
      <a href="../index.php" class="brand-logo"><i class="material-icons">cloud</i>Estoque</a>
      <ul class="right hide-on-med-and-down" id="sair">
        <li><a href="../engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
      </ul>
      <a href="../usuario/editar.php" class="right hide-on-med-and-down "><i class="large material-icons">account_circle</i>Usuário</a>
    </div>
  </nav>
  <br>
  <div class="col m12 s12">
    <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="consultar_produto.php" style="color: black; background: white; margin: .5em;"><i class="fa fa-arrow-left"></i> Voltar</a>
  </div>

  <center><h5 style="font-weight: 600;">Editar Dados do Produto</h5></center>
  <br>

  <div class="container">
   <?php require_once "../engine/config.php";

   $id = $_GET['id'];
   $valores = new Produto();
   $valores = $valores->Read($id);

   $nome_produto =  $valores['nome'];

   $quantidade = $valores['quantidade'];

   switch ($valores['tipo']) {
    case '0': $tipo_produto = "Caixa"; break;
    case '1': $tipo_produto = "Unidade"; break;
    case '2': $tipo_produto = "Outros"; break;
  }
  ?>

  <br><br>
  <div class="row">

   <div class="input-field col m6 s12">
    <input type="text" id="nome_produto" name="nome_produto" value="<?php echo $nome_produto;?>">
     <label ></label>
   </div>
   <div class="input-field col m6 s12">
     <input type="number" id="quantidade" name="quantidade" value="<?php echo $quantidade;?>">
     <label >Quantidade</label>
   </div>
 </div>
 <div class="row">
   <div class="input-field col m6 s12">
     <input type="text" id="tipo_produto" name="tipo_produto" value="<?php echo $tipo_produto;?>">
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

<script src="../js/jquery.js"></script>
<script src="../js/materialize.js"></script>

<script type="text/javascript">

  $('#Salvar').click(function(e) {
    e.preventDefault();
    var id = '<?php echo  $_GET['id']; ?>';
    var nome = $('#nome').val();
    var quantidade = $('#quantidade').val();
    var tipo = $('#tipo').val();

    if (nome === "" || quantidade === "" || tipo === ""){
      var $toastContent = $('<span>Preencha todos os campos!</span>');
      Materialize.toast($toastContent, 4000, 'rounded');
      return;
    }else{
      $.ajax({
        url: '../engine/controllers/produto.php',
        data: {
          id : id,
          nome : nome,
          quantidade : quantidade,
          tipo : tipo,

          action: 'update'
        },
        success: function(data) {
          if(data === 'true'){
            Materialize.toast("Dados Atualizados.", 3000, "rounded", function(){
              window.location.href = "../index.php";
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