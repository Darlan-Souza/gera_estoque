<?php
$showerros = true;
if ($showerros) {
    ini_set("display_errors", $showerros);
    error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}

session_start();
// Inicia a sessão

if (empty($_SESSION)) {
    ?>
    <script>
        document.location.href = '../login.php';
    </script>
<?php
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Estoque</title>

    <!-- CSS  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../css/somesystem.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../css/mbox-0.0.1.css" rel="stylesheet">
    <style type="text/css">
        @media screen and (min-width: 600px) {
            #tipo_tabela {
                width: 400px;
            }
        }

        .detalhes_usuario:hover .det {
            background: rgba(0, 169, 161, 0.3);
        }

        .apagar:hover {
            cursor: pointer;
            color: #fff;
            background-color: rgba(187, 36, 52, 0.9);
        }
    </style>
</head>

<body>
    <nav style="background:#2980b9 ;">
        <div class="nav-wrapper">
            <ul class="hide-on-med-and-down">
                <li><a href="../index.php" class="brand-logo"><i class="material-icons">cloud</i>Estoque</a></li>
            </ul>
            <ul class="right hide-on-med-and-down getout">
                <li><a href="../engine/controllers/logout.php"><i class="material-icons">arrow_forward</i></a></li>
            </ul>
            <ul class=" right hide-on-med-and-down">
                <li><a href="../usuario/editar.php"><i class="large material-icons">account_circle</i></a>
            </ul>
        </div>
    </nav>
    <br>
    <div class="col m12 s12">
        <a class="waves-effect waves-light btn <?php if ($flagUser == 1) echo 'hide' ?>" href="../index.php" style="color: black; background: white; margin: .5em;"><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>

    <center>
        <h5 style="font-weight: 600;">Solicitar novos produtos</h5>
    </center>
    <br>
    <div class="container">

        <div class="row">
            <br>
            <div class="input-field col m3"></div>
            <div class="input-field col m6 s12">
                <select name="fornecedor" id="fornecedor">
                    <?php
                    require_once "../engine/config.php";
                    $info = new Fornecedor();
                    $info = $info->ReadSelect();
                    ?>
                    <option value="" desabled selected>Selecione...</option>
                    <?php
                    foreach ($info as $todos) { ?>
                        <option value="<?php echo $todos['id']; ?>"><?php echo $todos['nome']; ?></option>';
                    <?php }
                    ?>
                </select>
                <label>Fornecedor*</label>
            </div>
        </div>
        <div class="col m12 s12">
            <center><a class="waves-effect waves-light btn <?php if ($flagUser == 1) echo 'hide' ?>" href="#modal1" style="color: black; background: rgba(9, 132, 227,.7); margin: .5em;"><i class="fas fa-check"></i> Solicitar </a></center>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 class="center title_responsivo">Enviar Mensagem</h4>

            <div class="row">

                <div class="input-field col s12 m12">
                    <input placeholder="Assunto do e-mail" id="assunto_email" type="text">
                    <label for="assunto_email">Assunto</label>
                </div>
                <div class="input-field col s12 m12" style=" margin-top: 10vh;">
                    <textarea id="obs_dor" placeholder="Descreva as solicitações" class="materialize-textarea" style="min-height: 10vh;"></textarea>
                    <label for="obs_dor">Descrição</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a id="enviar_email_user" class="waves-effect waves-green btn-flat green" style="color: white;">Enviar <i class="fa fa-check"></i></a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" style="color:#fff; background:rgba(214, 48, 49,.8);">Cancelar <i class="fa fa-times"></i></a>
        </div>
    </div>

    <!-- ========== footer ==================== -->
    <footer class="footer-psicologia">
        <p class="center"> &copy; <script>
                document.write(new Date().getFullYear())
            </script> Super Atacado, <small>Rua São Paulo, nº 5000 – Catedral. Diamantina-MG. CEP: 39100-000. <br>
                Contato: (38) 2354-6787.</small> </p>
    </footer>
</body>

</html>

<script src="../js/jquery.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/jquerymask.min.js"></script>
<script src="../js/mbox-0.0.1.js"></script>
<script src="../js/drop_materialize.js"></script>

<script>
    /*Para fazer o select aparecer*/
    window.onload = function() {
        $(document).ready(function() {
            $('select').material_select();
        });
    }

    $('.modal').modal();

    $('.getout').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: '../engine/controllers/logout.php',
            data: {},
            success: function(data) {
                if (data === 'kickme') {
                    document.location.href = '../login.php';
                } else {
                    alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
                }
            },
            type: 'POST'
        });
    });

    $('#enviar_email_user').click(function(e) {
        mbox.alert('Mensagem enviada com sucesso!', function() {
            location.reload();
        });
    });
</script>