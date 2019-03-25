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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    <?php require_once "engine/config.php";?>
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
            <th>Quantidade</th>
            <th>Tipo</th>
            <th>Apagar</th>
            <th>Editar</th>
          </tr>
        </thead>
        <tbody>
          <?php 

          $valores = new Produto();
          $valores = $valores->ReadAll();

          foreach($valores as $val) {

            //passo o nome da variável e o nome da variável que esta no banco
            $nome_produto = $val['nome'];

            $quantidade = $val['quantidade'];

            switch ($val['tipo']) {
              case '0': $tipo_produto = "Caixa"; break;
              case '1': $tipo_produto = "Unidade"; break;
              case '2': $tipo_produto = "Outros"; break;
            }
            ?>
            <tr>
              <td ><?php echo $nome_produto;?></td>
              <td><?php echo $quantidade;?></td>
              <td><?php echo $tipo_produto;?></td>
              <td class="apagar"><i class="fas fa-trash-alt"></i></td>
              <td class="editar"><i class="fas fa-edit"></i></td>
            </tr>
          <?php }?>
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


    $('.sair').click(function(e) {
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
  </script>