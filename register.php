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
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style_registro.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body ng-app="mainModule" ng-controller="mainController">  
  <center><h5 style="font-weight: 600;">Registro de usuário</h5></center>
  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col m12 s12">
          <input id="nome_registro" name="nome" type="text">
          <label>Nome Completo</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
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
        <button id="registrar_usuario" class="modal-action modal-close waves-effect waves-light btn medium-small darken-3">Registrar<i class="fa fa-arrow-right"></i></button>
      </div>
    </form>
  </div>
</body>

<script src="js/jquery.js"></script>
<script src="js/materialize.js"></script>
<script type="text/javascript">
  /*Para fazer o select aparecer*/
  window.onload=function(){
    $(document).ready(function() {
      $('select').material_select();
    });
  }

  /*Joga tudo no banco de dados*/
  $('#registrar_usuario').click(function(e) {
    e.preventDefault();

    var nome_registro = $('#nome_registro').val();
    var cpf_registro = $('#cpf_registro').val();
    var email_registro = $('#email_registro').val();
    var senha_registro = $('#senha_registro').val();

    if(nome_registro == "" || cpf_registro == "" || email_registro == "" || senha_registro == ""){
      alert('Preencha todos os campos que possuem *');
    }else if(senha_registro.length < 6){
      alert('Cadastre uma senha com mais de 6 digitos!');
    } else {
      $.ajax({
        url: 'engine/controllers/usuario.php',
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
            document.location.href = "login.php";
            /*O que isso faz?*/
            $.ajax({
              url: 'engine/controllers/login.php',
              data : {
                email_login : email_registro,
                senha_login : senha_registro
              },
              success: function(data){
                obj = JSON.parse(data);
                if(obj.res === 'true'){
                  window.location = 'login.php';
                } else {
                  alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
                }
              },
              async: false,
              type : 'POST'
            });
          }
        },
        async: false,
        type : 'POST'
      });
    }
  });
</script>
