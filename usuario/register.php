    <?php
    $showerros = true;
    if($showerros) {
      ini_set("display_errors", $showerros);
      error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
    }
    ?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title>Estoque</title>

      <!-- CSS  -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="../css/style_registro.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="../css/mbox-0.0.1.css"/>
    </head>

    <body>  
      <br>
      <center><h5 style="font-weight: 600;">Registro de usuário</h5></center>
      <br>
      <div class="col m12 s12">
        <a class="waves-effect waves-light btn" href="../index.php" style="background: #2e7d32; color: white; margin: 1em;"><i class="fas fa-arrow-left"></i> Voltar</a>
      </div>
      <br>
      <div class="container">
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col m6 s12">
                <input id="nome_registro" name="nome" type="text">
                <label>Nome Completo*</label>
              </div>

              <div class="input-field col m6 s12">
                <input id="cpf_registro" name="cpf" type="text" required placeholder="000.000.000.00">
                <label>CPF*</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col m6 s12">
                <input id="email_registro" name="email" type="email">
                <label>E-mail*</label>
              </div>
              <div class="input-field col m6 s12">
                <input type="password" name="senha" id="senha_registro">
                <label>Senha*</label>
              </div>
            </div>

            <div class="modal-footer">
              <center><button id="registrar_usuario" class="modal-action modal-close waves-effect waves-light btn medium-small darken-3">Registrar <i class="fa fa-arrow-right"></i></button></center>
            </div>
          </form>
        </div>
      </div>

    </body>
    </html>

    <script src="../js/jquery.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/jquerymask.min.js"></script>
    <script src="../js/mbox-0.0.1.js"></script>

    <script>

      /*Para fazer o select aparecer*/
      window.onload=function(){
        $(document).ready(function() {
          $('select').material_select();
        });
      }

      $('#cpf_registro').mask('999.999.999-99');

      /*Joga tudo no banco de dados*/
      $('#registrar_usuario').click(function(e) {
        e.preventDefault();

        var nome_registro = $('#nome_registro').val();
        var cpf_registro = $('#cpf_registro').val();
        var email_registro = $('#email_registro').val();
        var senha_registro = $('#senha_registro').val();

        if(nome_registro == "" || cpf_registro == "" || email_registro == "" || senha_registro == ""){
          return mbox.alert('Preencha todos os campos que possuem *');
        }else if(senha_registro.length < 6){
          return mbox.alert('Cadastre uma senha com mais de 6 digitos!');
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
                Materialize.toast("Cadastro Realizado com Sucesso!", 1500, "rounded", function(){
                  window.location = "../login.php"                    
                });
              }
            },
            async: false,
            type : 'POST'
          });
        }
      });  

    </script>
