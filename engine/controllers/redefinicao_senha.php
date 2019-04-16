<?php
	require_once "../config.php";

	$id = $_POST['id'];
	$cpf_usuario = $_POST['cpf_usuario'];
	$email_usuario = $_POST['email_usuario'];

	$action = $_POST['action'];

	$Item = new Redefinicao_senha();
	$Item->SetValues($id, $cpf_usuario, $email_usuario);

	switch($action) {
		case 'create':
			$res = $Item->Create();
			if ($res === NULL) {
				$res = "true";
			} else {
				$res = "false";
			}
			echo $res;
		break;

		case 'update':
			$res = $Item->Update();

			if ($res === NULL) {
				$res= 'true';
			} else {
				$res = 'false';
			}
			echo $res;
		break;

		case 'delete':
			$res = $Item->Delete();
			if ($res === NULL) {
				$res= 'true';
			} else {
				$res = 'false';
			}
			echo $res;
		break;
	}
?>