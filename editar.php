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
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav>
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo"><i class="material-icons">cloud</i>Estoque</a>
      <ul class="right hide-on-med-and-down" id="sair">
        <li><a href="engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid" style="min-height: 100vh;">
    <div class="row">
      <br>
      <div class="col m12 s12">
        <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="index.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a>
      </div>
    </div>
    <table class="responsive-table centered">
      <thead style="background: #2980b9; color: #fff;">
        <tr>
          <th>Nome</th>
          <th>Nome</th>
          <th>Apagar</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $_SESSION['nome']; ?></td>
          <td><?php echo $_SESSION['ciadde']; ?></td>
          <td><i class="fa fa-trash fa-lg"></i>Lixo</td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer class="footer-adm">
  </footer>

  <script src="../js/jquery.js"></script>
  <script src="../js/jquerymask.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/drop_materialize.js"></script>
  <script src="../js/timer.js"></script>
  <script src="../js/mbox-0.0.1.js"></script>
  <script src="../js/toastr.min.js"></script>

</body>
</html>

<script type="text/javascript">

    //chamando o menu
    $('#nav-menu').load('../menu.php?diretorio='+ 1 +'&nav_color=nav-adm');

    $('.det').click(function(e) {
      var id = $(this).attr('id');
      window.location = "detalhes.php?id="+id;
    });

    $('.getout').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: '/engine/controllers/logout.php',
        data: {
        },
        success: function(data) {
          if(data === 'kickme')
            document.location.href = '../';
          else
            alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
        },
        type: 'POST'
      });
    });


    $('#pesquisar').click(function(e) {
      e.preventDefault();
      var tipo = $('#tipo').val();
      if(tipo == 0){
        var pesq = $('#pesq_nome').val();
        if(pesq == ""){
          return toastr.error('Preencha o campo de pesquisa!');
        }else{
          window.location = "pesquisa/pesq_acessibilidade.php?pesq="+pesq+"&tipo="+tipo;
        }
      }else if(tipo == 1){
        var pesq = $('#campus_pesq').val();
        window.location = "pesquisa/pesq_acessibilidade.php?pesq="+pesq+"&tipo="+tipo;
      }else if(tipo == 2){
        var pesq = $('#defici_pesq').val();
        window.location = "pesquisa/pesq_acessibilidade.php?pesq="+pesq+"&tipo="+tipo;
      }else if(tipo == 3){
        var pesq = $('#user_pesq').val();
        window.location = "pesquisa/pesq_acessibilidade.php?pesq="+pesq+"&tipo="+tipo;
      }
    });

    $(".apagar").click(function(e) {
      e.preventDefault();
      var id = $(this).attr('id');
      mbox.confirm('Deseja Excluir esta solicitação?', function(yes) {
        if (!yes) {
          return false;
        } else {
          $.ajax({
            url: '../engine/controllers/acessibilidade_inclusao.php',
            data: {
              id : id,
              action: 'delete'
            },
            async: false,
            type: 'POST'
          });
        }
      });
    });
  </script>