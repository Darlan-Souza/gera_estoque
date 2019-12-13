<?php
$showerros = true;
if ($showerros) {
  ini_set("display_errors", $showerros);
  error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}
session_start();

if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
  header("Location: https://localhost/gera_estoque/login.php", true, 301);
  exit;
}
?>

<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

  <style>
    html,
    body {
      height: 100%;
    }

    html {
      display: table;
      margin: auto;
    }

    body {
      display: table-cell;
      vertical-align: middle;
      background: rgba(108, 92, 231, .7);
    }

    #login-page {
      width: 400px;
    }

    .card {
      position: absolute;
      left: 50%;
      top: 50%;
      -moz-transform: translate(-50%, -50%) -webkit-transform: translate(-50%, -50%) -ms-transform: translate(-50%, -50%) -o-transform: translate(-50%, -50%) transform: translate(-50%, -50%);
    }

    hr {
      border-color: #aaa;
      box-sizing: border-box;
      width: 100%;
    }
  </style>


</head>

<body>
  <div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
      <div class="center">
        <img src="img/login.png" style="width: 200px;">
      </div>
      <hr>
      <form class="login-form">
        <div class="row">
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mail_outline</i>
            <input class="validate" id="email_login" type="email">
            <label for="email_login">E-mail</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input id="senha_login" type="password">
            <label for="password">Senha</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l12  login-text">
            <input type="checkbox" id="remember-me" />
            <label for="remember-me">Salvar</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <a href="#" id="login_usuario" class="btn waves-effect waves-light col s12">Login</a>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="usuario/register.php" style="color:rgba(0, 184, 148,1.0); font-size:18px;"><b>Criar conta!</b></a></p>
          </div>
        </div>

      </form>
    </div>
  </div>
</body>

</html>

<script src="js/jquery.js"></script>
<script src="js/materialize.js"></script>

<script type="text/javascript">
  /*Para fazer o select aparecer*/
  window.onload = function() {
    $(document).ready(function() {
      $('select').material_select();
    });
  }
  $(document).ready(function(e) {

    $('#login_usuario').click(function(e) {
      e.preventDefault();

      var email_login = $('#email_login').val();
      var senha_login = $('#senha_login').val();

      if (email_login == "" || senha_login == "") {
        return mbox.alert('Preencha todos os campos!');
      } else {
        $.ajax({
          url: 'engine/controllers/login.php',
          data: {
            email_login: email_login,
            senha_login: senha_login
          },
          success: function(data) {
            obj = JSON.parse(data);
            if (obj.res === 'true') {
              window.location = "index.php";
            } else if (obj.res === 'no_user_found') {
              return mbox.alert('Usuário não encontrado.');
            } else if (obj.res === 'wrong_password') {
              return mbox.alert('Senha Incorreta.');
            } else {
              return mbox.alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
            }
          },
          async: false,
          type: 'POST'
        });
      }
    });
  });
</script>