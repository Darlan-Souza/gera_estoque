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
  <nav>
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo"><i class="material-icons">cloud</i>Estoque</a>
      <ul class="right hide-on-med-and-down" id="sair">
        <li><a href="engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
      </ul>
    </div>
  </nav>
  <?php require_once "engine/config.php";
	$item_por_pag = 40;

	$x = new Produto();
	$infoNum = 0;

	$pagina = intval($_GET['pagina']);
	$num_paginas = ceil($infoNum/$item_por_pag);
	$item = 0;
	for($a = 0; $a<$pagina; $a++){
		$item = $item+$item_por_pag;
	}

	$info = new Produto();
	?>

	<div class="container-fluid" style="min-height: 100vh;">
       <h5 class="center"> Consultas</h5>
		<div class="row">
			<div class="col m12 s12">
				<a class="waves-effect waves-light btn <?php if($flagUser == 1) echo 'hide' ?>" href="../index.php" style="color: black; background: white;"><i class="fa fa-arrow-left"></i> Voltar</a>
			</div>

			<form class="col s12">
				<div class="col m8 s12"></div>
				<div class="input-field col m2 s5" id="solici_aberto">
					<input placeholder="Pesquisar por..." id="pesq_nome" name="pesq_nome" type="text">
				</div>	
			</form>
		</div>
		<?php
		if(empty($info)){
			echo '<h4 class="center"> Nenhum dado encontrado! </h4>';
		}else{
			?>
			<table class="responsive-table centered">
				<thead style="background: #2980b9; color: #fff;">
					<tr>
						<th>Nome Produto</th>
						<th>Quantidade Produto</th>
						<th>Tipo</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($info as $item) {
						$nome_produto = $item['nome_produto'];
						$user = new Produto();
						$user = $user->Read($item['nome_produto']);

						switch ($user['possui_deficiencia']) {
							case '': $possui_deficiencia = "Não"; break;
							case '0': $possui_deficiencia = "Não"; break;
							case '1': $possui_deficiencia = "Sim"; break;
						}						

						switch ($user['tipo_deficiencia']) {
							case '0': $tipo_deficiencia = "Auditiva"; break;
							case '1': $tipo_deficiencia = "Física"; break;
							case '2': $tipo_deficiencia = "Visual"; break;
							case '3': $tipo_deficiencia = "Mental"; break;
							case '4': $tipo_deficiencia = "Múltipla"; break;
						}

						if($possui_deficiencia == "Não"){
							$tipo_deficiencia = "-";
						}

						$orientacao_pedagogica = ($item['orientacao_pedagogica'] == "" || $item['orientacao_pedagogica'] == null) ? 0 : 1;
						$servico_especial = ($item['servico_especial'] == "" || $item['servico_especial'] == null) ? 0 : 1;
						?>
						
					<?php } ?>
				</tbody>
			</table>

			<?php } ?>
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
