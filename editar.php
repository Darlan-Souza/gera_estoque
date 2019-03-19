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
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

  <?php require_once "engine/config.php"; 
    $usuario = new Usuario();

    //Read é uma função na classe usuario
    $usuario = $usuario->Read($_SESSION['id']);
    ?>

    <div class="news" style="margin-top: -7em;">
      <div class="container">
          <div class="col-lg-12">
            <br>
            <br>
            <br>      
            <h3 class="center">Editar Dados</h3>
          </div>

          <div class="col-lg-12">
            <form class="contact_form">
              <div class="row">
                <div class="col-md-12">
                  <input type="text" class="contact_input" id="nome_registro" placeholder="Nome" value="<?php echo $usuario['nome']; ?>" required="required">
                </div>

                <div class="col-md-4 col-sd-12">
                  <input type="text" class="contact_input" id="data_nasc_registro" placeholder="Data de Nascimento" value="<?php echo $usuario['nascimento']; ?>" required="required">
                </div>

                <div class="col-md-4 col-sd-12">
                  <input type="text" class="contact_input" id="rua_registro" placeholder="Rua" value="<?php echo $usuario['rua']; ?>" required="required">
                </div>

                <div class="col-md-12">
                  <input type="text" class="contact_input" id="numero_registro" placeholder="Numero" value="<?php echo $usuario['numero']; ?>" required="required">
                </div>

                <div class="col-md-8 col-sd-12">
                  <input type="text" class="contact_input" id="cidade_registro" placeholder="Cidade" value="<?php echo $usuario['cidade']; ?>" required="required">
                </div>

                <div class="col-md-4 col-sd-12">
                  <input type="text" class="contact_input" id="estado_registro" placeholder="Estado" value="<?php echo $usuario['estado']; ?>" required="required">
                </div>

                <div class="col-md-4 col-sd-12">
                  <input type="text" class="contact_input" id="cpf_registro" placeholder="CPF" value="<?php echo $usuario['cpf']; ?>" required="required">
                </div>

                <div class="col-md-4 col-sd-12">
                  <input type="text" class="contact_input" id="email_registro" placeholder="E-mail" value="<?php echo $usuario['email']; ?>" required="required">
                </div>
                <div class="col-md-12">
                  <p class="text-center"><button type="button" class="btn btn-secondary" id="atualizar">Atualizar</button></p>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
  <footer >
  </footer>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
<script>

  $('#atualizar').click(function(e) {
        e.preventDefault();

        var id = "<?php echo $_SESSION['id']; ?>";
        var nome_registro = $('#nome_registro').val();
        var data_nasc_registro = $('#data_nasc_registro').val();
        var rua_registro = $('#rua_registro').val();
        var numero_registro = $('#numero_registro').val();
        var cidade_registro = $('#cidade_registro').val();
        var estado_registro = $('#estado_registro').val();
        var cpf_registro = $('#cpf_registro').val();
        var email_registro = $('#email_registro').val();

        if(nome_registro == "" || data_nasc_registro == "" || rua_registro == "" || numero_registro == "" || cidade_registro == "" || estado_registro == ""|| cpf_registro == ""|| email_registro == ""){
          alert('Preencha todos os campos!');
        } else {
          $.ajax({
            url: 'engine/controllers/usuario.php',
            data : {
              id : id,
              nome: nome_registro,
              nascimento: data_nasc_registro,
              rua : rua_registro,
              numero: numero_registro,
              cidade : cidade_registro,
              estado: estado_registro,
              cpf : cpf_registro,
              email: email_registro,

              action: 'update'
            },
            success: function(data){
              if(data === 'true'){
                alert("Dados atualizados com Sucesso!");
                location.reload();
              }
            },
            async: false,
            type : 'POST'
          });
        }
      });

  $('.sair').click(function(e) {
        e.preventDefault();
        $.ajax({
          url: 'engine/controllers/logout.php',
          data: {

          },
          error: function() {
            alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
          },
          success: function(data) {
            console.log(data);
            if(data === 'kickme'){
              document.location.href = 'index.php';
            }

            else{
              alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
            }
          },

          type: 'POST'
        });
      });
</script>
