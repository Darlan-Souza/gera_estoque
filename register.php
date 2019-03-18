<?php
$showerros = true;
if($showerros) {
  ini_set("display_errors", $showerros);
  error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}
/*<script src="js/materialize.min.js"></script> 
uso o js para fazer o formulario subir quando clicado
*/
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

<div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col m12 s6">
          <input id="nome_registro" name="nome" type="text">
          <label>Nome Completo</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col m6 s12">
          <select name="sexo" id="genero_registro">
            <option value="" desabled selected>Selecione...</option>
            <option value="0">Masculino</option>
            <option value="1">Feminino</option>
            <option value="2">Outros</option>
          </select>
          <label>Gênero</label>
        </div>
        <div class="input-field col m6 s12">
          <input type="text" class="datepicker" id="data_nasc_registro" name="nascimento" required placeholder="dd/mm/aaaa">
          <label>Data de Nascimento</label>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="input-field col m6 s6">
          <input id="rua_registro" name="rua" type="text">
          <label>Rua</label>
        </div>
        <div class="input-field col m6 s6">
          <input id="numero_registro" name="numero" type="number">
          <label>Número</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s6">
          <input id="cidade_registro" name="cidade" type="text">
          <label>Cidade</label>
        </div>
        <div class="input-field col m6 s12">
          <select name="select_estado" id="estado_registro">
            <option value="" disabled selected>Selecione...</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espirito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MT">Mato Grosso</option>
            <option value="MG" selected>Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
          </select>
        <label>Estado</label>
    </div>
      </div>

      <div class="row">
        <div class="input-field col s6">
          <input id="cpf_registro" name="cpf" type="text" required placeholder="000.000.000.00">
          <label>CPF</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col m6 s6">
          <input id="email_registro" name="email" type="email">
          <label>E-mail</label>
        </div>
        <div class="input-field col m6 s6">
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
        var genero_registro = $('#genero_registro').val();
        var data_nasc_registro = $('#data_nasc_registro').val();
        var rua_registro = $('#rua_registro').val();
        var numero_registro = $('#numero_registro').val();  
        var cidade_registro = $('#cidade_registro').val();  
        var estado_registro = $('#estado_registro').val();
        var cpf_registro = $('#cpf_registro').val();
        var email_registro = $('#email_registro').val();
        var senha_registro = $('#senha_registro').val();

        if(nome_registro == "" || genero_registro == "" || data_nasc_registro == "" || rua_registro == "" || numero_registro == "" || cidade_registro == "" || estado_registro == "" || cpf_registro == "" || email_registro =="" || senha_registro ==""){
          alert('Preencha todos os campos que possuem *');
        }else if(senha_registro.length < 6){
          alert('Cadastre uma senha com mais de 6 digitos!');
        } else {
          $.ajax({
            url: 'engine/controllers/usuario.php',
            data : {
              nome: nome_registro,
              sexo : genero_registro,
              nascimento: data_nasc_registro,
              rua: rua_registro,
              numero : numero_registro,
              cidade: cidade_registro,
              estado : estado_registro,
              cpf : cpf_registro,
              email : email_registro,
              senha : senha_registro,

              action: 'create'
            },
            success: function(data){
              obj = JSON.parse(data);
              if(obj.res === 'true'){
                alert("Cadastro Realizado com Sucesso!");
                window.location = "login.php";
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
                      location.reload();
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
