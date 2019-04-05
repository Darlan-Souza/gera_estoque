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
        document.location.href = '../login.php' ;
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
      <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <style type="text/css">
        @media screen and (min-width: 600px) {
          #tipo_tabela{
            width: 400px;
          }
        }
        .detalhes_usuario:hover .det{
          background: rgba(0, 169, 161, 0.3);
          cursor: pointer;
        }
        .apagar:hover{
          cursor:pointer;
          color: #fff;
          background-color: rgba(187, 36, 52, 0.9);
        }
      </style>
    </head>
    <body>
      <?php require_once "../engine/config.php";
      $pesq = $_GET['pesq'];
      ?>
      <nav style="background:#2980b9 ;">
        <div class="nav-wrapper">
          <ul class="hide-on-med-and-down">
            <li><a href="../index.php" class="brand-logo"><i class="material-icons">cloud</i>Estoque</a></li>
          </ul>
          <ul class="right hide-on-med-and-down getout">
            <li><a href="../engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
          </ul>
          <ul class=" right hide-on-med-and-down">
            <li><a href="usuario/editar.php"><i class="large material-icons">account_circle</i></a>
            </ul>
          </div>
        </nav>
        
        <div class="container-fluid" style="min-height: 100vh;">
          <div class="row">
            <br>
            <div class="col m12 s12">
              <a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="../index.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a>
            </div>

            <form class="col s12">
              <div class="input-field col m2 s5" id="solici_aberto">
                <input placeholder="Pesquisar por..." id="pesq_nome" name="pesq_nome" type="text">
              </div>

              <div class="input-field col m1 s1">
                <a class="waves-effect waves-light btn" style="background: #2980b9;" id="pesquisar"><i class="fa fa-search"></i></a>
              </div>
            </form>
          </div>

          <?php 
          $info = new Produto();
          $info = $info->Pesq($_SESSION['id'], $pesq);

          if(empty($info)){

            echo '<center><h4>Nenhum dado encontrado!</h4></center>';
          }else{
            ?>

            <table class="responsive-table centered">
              <thead style="background: #2980b9; color: #fff;">
                <tr>
                  <th>Nome</th>
                  <th>Quantidade</th>
                  <th>Tipo</th>
                  <th>Valor R$</th>
                  <th>Apagar</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($info as $val) {

              //passo o nome da variável e o nome da variável que esta no banco

                  $nome_produto = $val['nome'];

                  $quantidade = $val['quantidade'];

                  switch ($val['tipo']) {
                    case '0': $tipo_produto = "Caixa"; break;
                    case '1': $tipo_produto = "Unidade"; break;
                    case '2': $tipo_produto = "Outros"; break;
                  }

                  $custo = $val['valor'];
                  ?>
                  <tr class="detalhes_usuario">
                    <td class="det" id="<?php echo $val['id']; ?>"><?php echo $nome_produto;?></td>
                    <td class="det" id="<?php echo $val['id']; ?>"><?php echo $quantidade;?></td>
                    <td class="det" id="<?php echo $val['id']; ?>"><?php echo $tipo_produto;?></td>
                    <td class="det" id="<?php echo $val['id']; ?>"><?php echo "R$ ", $custo, ",00";?></td>
                    <td class="apagar" id="<?php echo $val['id']; ?>"><i class="fa fa-trash fa-lg"></i> </td>
                  </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>

        </body>
        </html>

        <script src="../js/jquery.js"></script>
        <script src="../js/materialize.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            $('.det').click(function(e) {
              var id = $(this).attr('id');
              window.location = "edita_produto.php?id="+id;
            });

            $('.getout').click(function(e) {
              e.preventDefault();

              $.ajax({
                url: '../engine/controllers/logout.php',
                data: {},
                success: function(data) {
                  if(data === 'kickme'){
                    document.location.href = '../login.php';
                  } else {
                    alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
                  }
                },
                type: 'POST'
              });
            });

            $(".apagar").click( function(event) {
              var apagar = confirm('Deseja realmente excluir este registro?');
              if (apagar){
                var id = $(this).attr('id');
                $.ajax({
                  url: '../engine/controllers/produto.php',
                  data: {
                    id : id,

                    action: 'delete'
                  },
                  success: function(data) {
                    if(data === 'true'){
                      Materialize.toast("Solicitação excluida.", 3000, "rounded", function(){
                        location.reload();
                      });
                    }
                  },
                  async: false,
                  type: 'POST'
                });      
              }else{
               event.preventDefault();
             } 
           });


            $('#pesquisar').click(function(e) {
              e.preventDefault();
              var pesq = $('#pesq_nome').val();
              if(pesq == ""){
                return toastr.error('Preencha o campo de pesquisa!');
              }else{
                window.location = "consultar_produto_resultado.php?pesq="+pesq;
              } 
            });
          });



        </script>