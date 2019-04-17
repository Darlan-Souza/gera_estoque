<?php
$showerros = true;
if($showerros) {
  ini_set("display_errors", $showerros);
  error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}
session_start();

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
  <link href="css/style_login.css" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="css/mbox-0.0.1.css"/>
</head>

<body>
  <div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel" style="background: rgba(52, 73, 94,.8); border-radius: 1em;">

      <p class="center" style="color: #fff; font-size: 2em; height: 0.5em; font-weight: 700;">Login</p>
      <form class="login-form">
        <div class="row">
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mail_outline</i>
            <input class="validate" id="email_login" type="email">
            <label for="email_login">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input id="senha_login" type="password">
            <label for="password">Senha</label>
          </div>
        </div>

        <div class="modal-footer">
          <center><button id="login_usuario" class="btn waves-effect waves-light" type="submit" name="action">Entrar<i class="material-icons right">send</i></button></center>
        </div>
        <br>
        <div class="row">
          <div>
            <a href="usuario/register.php" class="waves-effect waves-light btn-small"><p style="font-weight: 500; font-size: 1em; background: rgba(127, 140, 141,.5); padding: 7px; border-radius: 10px; color: #fff;">Registro</p></a>
            <a href="login/esqueci_senha.php" class="waves-effect waves-light btn-small"><p style="font-weight: 500; font-size: 1em; background: rgba(127, 140, 141,.5); padding: 7px; border-radius: 10px; color: #fff;">Recuperar senha!</p></a>
          </div>         
        </div>
      </form>
    </div>
  </div> 
</body>

<script src="js/jquery.js"></script>
<script src="js/materialize.js"></script>
<script src="js/mbox-0.0.1.js"></script>

<script type="text/javascript">

  /*Para fazer o select aparecer*/
  window.onload=function(){
    $(document).ready(function() {
      $('select').material_select();
    });
  }
  $(document).ready(function(e) {

    $('#login_usuario').click(function(e) {
      e.preventDefault();

      var email_login = $('#email_login').val();
      var senha_login = $('#senha_login').val();

      if(email_login == "" || senha_login == ""){
        return mbox.alert('Preencha todos os campos!');
      } else {
        $.ajax({
          url: 'engine/controllers/login.php',
          data : {
            email_login : email_login,
            senha_login : senha_login
          },
          success: function(data){
            obj = JSON.parse(data);
            if(obj.res === 'true'){
              window.location = "index.php";
            } else if(obj.res === 'no_user_found') {
              return mbox.alert('Usuário não encontrado.');
            } else if(obj.res === 'wrong_password') {
              return mbox.alert('Senha Incorreta.');
            } else {
              return mbox.alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
            }
          },
          async: false,
          type : 'POST'
        });
      }
    });
  });
</script>
