<?php
require_once "../engine/config.php";

header('Content-type: text/plain; charset=utf-8');

include('phpMailer/PHPMailerAutoload.php');

$Usuario = new Usuario();
$Usuario = $Usuario->ReadByEmail($_POST['email']);


if($Usuario){
  $email = $Usuario['email'];
  $nome = $Usuario['nome'];
}

$codigo = $_POST['id'];

//enviando por email
$mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
$mail->SMTPDebug = 0;
$mail->IsSMTP(); // Define que a mensagem serÃ¡ SMTP
$mail->Host = "smtp.ufvjm.edu.br"; // EndereÃ§o do servidor SMTP (caso queira utilizar a autenticaÃ§Ã£o, utilize o host smtp.seudomÃ­nio.com.br)
$mail->SMTPAuth = true; // Usar autenticaÃ§Ã£o SMTP (obrigatÃ³rio para smtp.seudomÃ­nio.com.br)
$mail->Username = 'sistema.dasa@ufvjm.edu.br'; // UsuÃ¡rio do servidor SMTP (endereÃ§o de email)
$mail->Password = 'D@SA_sis#144#'; // Senha do servidor SMTP (senha do email usado)
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = "sistema.dasa@ufvjm.edu.br"; // Seu e-mail
$mail->Sender = "sistema.dasa@ufvjm.edu.br"; // Seu e-mail
$mail->FromName = mb_encode_mimeheader("Sistema de Serviços Online - DASA/PROACE", "UTF-8"); // Seu nome
// Define os destinatÃ¡rio(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// $mail->AddAddress('marlonparanhos144@gmail.com', 'Marlon');
$mail->AddAddress($email, $nome);
// $mail->AddCC($email_profissional, $servidor_saude); // Copia
// $mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // CÃ³pia Oculta
// Define os dados tÃ©cnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail serÃ¡ enviado como HTML
//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = mb_encode_mimeheader("Serviço de Psicologia/UFVJM - Redefinição de Senha","UTF-8"); // Assunto da mensagem
$mail->Body = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Untitled Document</title>
</head>
<body>

<div style="width:100%; height: 100vh;" align="center">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" >
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20" align="left" valign="top" bgcolor="#000000" style="background-color:#ffffff;">&nbsp;</td>
            <td align="center" valign="top" bgcolor="#000000" style="background-color:#ffffff; color:#7b7b7b; font-family: Roboto, sans-serif; font-size:14px;"><br>
              <br>
            <br>
            
            <img src="https://i.imgur.com/3s9ANrJ.png" width="550" height="auto" style="display:block;"><br><br>

            <div style="color:#7b7b7b; font-family: Roboto, sans-serif; font-size:16px; text-align: center;">
            <b>Redefinição de Senha de acesso ao sistema DASA</b><br><br>

            '.$nome.', recebemos uma solicitação de alteração de senha.<br>
            <a href="http://proace.ufvjm.edu.br/dasa/login/redefinir_senha.php?token='.$codigo.'">Clique aqui</a> para ser redirecionado para a tela de redefinição.
            </p><br><br>

              <strong>Mensagem automática, favor não responder.</strong>
            </div>
            <br>
            <br>
            <br>
            <div style="color:#7b7b7b; font-family: Roboto, sans-serif; font-size:14px;"><!-- <b>Contato</b> <br> -->
              Campus JK. Rodovia MGT 367 - km 583, nº 5000 – Alto da Jacuba. Diamantina-MG. CEP: 39100-000. 
            PABX: (38) 3532-6871.
            <br>
            <br>
            <br>
            <br>
            <br>
            </div>
            </td>
            <td width="20" align="left" valign="top" bgcolor="#000000" style="background-color:#ffffff;">&nbsp;</td>
          </tr>
        </table>
    </td>
  </tr>
</table>

</div>

</body>
</html>
';

$mail->CharSet = 'UTF-8';

// Envia o e-mail
$enviado = $mail->Send();
// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();
$result = "";

echo 'true';
?>