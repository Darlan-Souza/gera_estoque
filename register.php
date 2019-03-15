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
          <input id="nome" name="nome" type="text">
          <label>Nome Completo</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col m6 s12">
          <select name="sexo" id="sexo">
            <option value="" desabled selected>Selecione...</option>
            <option value="0">Masculino</option>
            <option value="1">Feminino</option>
            <option value="2">Outros</option>
          </select>
          <label>Gênero</label>
        </div>
        <div class="input-field col m6 s12">
          <input type="text" class="datepicker" id="nascimento" name="nascimento" required placeholder="dd/mm/aaaa">
          <label>Data de Nascimento</label>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="input-field col m6 s6">
          <input id="rua" name="rua" type="text">
          <label>Rua</label>
        </div>
        <div class="input-field col m6 s6">
          <input id="numero" name="numero" type="number">
          <label>Número</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s6">
          <input id="cidade" name="cidade" type="text">
          <label>Cidade</label>
        </div>
        <div class="input-field col m6 s12">
          <select name="select_estado" id="estado">
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
          <input id="cpf" name="cpf" type="text" required placeholder="000.000.000.00">
          <label>CPF</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col m6 s6">
          <input id="email" name="email" type="email">
          <label>E-mail</label>
        </div>
        <div class="input-field col m6 s6">
          <input type="password" name="senha" id="senha">
          <label>Senha</label>
        </div>
      </div>
      <div class="modal-footer">
        <button id="confirmar_dados" class="modal-action modal-close waves-effect waves-light btn green darken-3">Registrar<i class="fa fa-arrow-right"></i></button>
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
</script>
