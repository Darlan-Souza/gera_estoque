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
      <a href="../editar.php" class="right hide-on-med-and-down "><i class="large material-icons">account_circle</i>Usuário</a>
    </div>
  </nav>
  <br>
  <div class="col m12 s12">
    <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="../index.php" style="color: black; background: white; margin: .5em;"><i class="fa fa-arrow-left"></i> Voltar</a>
  </div>

  <center><h5 style="font-weight: 600;">Registro de usuário</h5></center>
  <br>
  <div class="container">
    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col m6 s12">
            <input id="nome_registro" name="nome" type="text">
            <label>Nome Completo</label>
          </div>

          <div class="input-field col m6 s12">
            <input id="cpf_registro" name="cpf" type="text" required placeholder="000.000.000.00">
            <label>CPF</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col m6 s12">
            <input id="email_registro" name="email" type="email">
            <label>E-mail</label>
          </div>
          <div class="input-field col m6 s12">
            <input type="password" name="senha" id="senha_registro">
            <label>Senha</label>
          </div>
        </div>

        <div class="modal-footer">
          <center><button id="registrar_usuario" class="modal-action modal-close waves-effect waves-light btn medium-small darken-3">Registrar<i class="fa fa-arrow-right"></i></button></center>
        </div>
      </form>
    </div>
  </div>

</body>
</html>

<script src="../js/jquery.js"></script>
<script src="../s/materialize.js"></script>
<script src="../js/jquerymask.min.js"></script>

<script>
  $('#cpf_registro').mask('999.999.999-99');

  /*Joga tudo no banco de dados*/
  $('#registrar_usuario').click(function(e) {
    e.preventDefault();

    var nome_registro = $('#nome_registro').val();
    var cpf_registro = $('#cpf_registro').val();
    var email_registro = $('#email_registro').val();
    var senha_registro = $('#senha_registro').val();

    if(nome_registro == "" || cpf_registro == "" || email_registro == "" || senha_registro == ""){
      alert('Preencha todos os campos!');
    }else if(senha_registro.length < 6){
      alert('Cadastre uma senha com mais de 6 digitos!');
    } else {
      $.ajax({
        url: '../engine/controllers/usuario.php',
        data : {
          nome: nome_registro,
          cpf : cpf_registro,
          email : email_registro,
          senha : senha_registro,

          action: 'create'
        },
        success: function(data){
          obj = JSON.parse(data);
          if(obj.res === 'true'){
            alert("Cadastro Realizado com Sucesso!");
            document.location.href = "../login.php";
          }
        },
        async: false,
        type : 'POST'
      });
    }
  });  

</script>
