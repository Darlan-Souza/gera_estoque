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
    <link href="css/style_registro.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>

  <body ng-app="mainModule" ng-controller="mainController">  
    <center><h5 style="font-weight: 600;">Inserir Produto</h5></center>
    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col m12 s12">
            <input id="nome_produto" name="nome_produto" type="text">
            <label>Nome Produto</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col m6 s12">
            <select name="tipo_produto" id="tipo_produto">
              <option value="" desabled selected>Selecione...</option>
              <option value="0">Caixa</option>
              <option value="1">Unidade</option>
              <option value="2">Outros</option>
            </select>
            <label>Tipo Produto</label>
          </div>
          <div class="input-field col m6 s12">
            <input id="quantidade_produto" name="quantidade_produto" type="number">
            <label>Quantidade</label>
          </div>
        </div>

        <div class="modal-footer">
          <button id="registrar_produto" class="modal-action modal-close waves-effect waves-light btn medium-small darken-3">Registrar<i class="fa fa-arrow-right"></i></button>
        </div>
      </form>
    </div>
    <div class="col m12 s12">
      <p style="text-align: center;"><a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="index.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a></p>
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
    $('#registrar_produto').click(function(e) {
      e.preventDefault();

      var nome_produto = $('#nome_produto').val();
      var quantidade_produto = $('#quantidade_produto').val();
      var tipo_produto = $('#tipo_produto').val();
      var id_usuario = '<?php echo $_SESSION['id'];?>';

      if(nome_produto == "" || quantidade_produto == "" || tipo_produto == ""){
        alert('Preencha todos os campos que possuem *');
      }else {
        $.ajax({
          url: 'engine/controllers/produto.php',
          data : {
            fk_usuario : id_usuario,
            nome_produto: nome_produto,
            quantidade : quantidade_produto,
            tipo_produto: tipo_produto,

            action: 'create'
          },
          success: function(data){
            obj = JSON.parse(data);
            if(obj.res === 'true'){
              alert("Cadastro Realizado com Sucesso!");
              //location.reload();
              window.location = "index.php";
            }
          },
          async: false,
          type : 'POST'
        });
      }
    });
  </script>
