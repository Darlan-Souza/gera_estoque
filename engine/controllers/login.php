<?php session_start();

	require_once "../config.php";

	$matricula = addslashes($_POST['matricula_login']);
	$senha = addslashes($_POST['senha_login']);
	$res;

	$Usuario = new Usuario();
	$Usuario = $Usuario->ReadByMatricula($matricula);


	if ($Usuario === NULL) {
		$res = 'no_user_found';
		session_destroy();
	} else {
		$verificaEmail = strcmp($matricula,$Usuario['matricula']);
		if ($verificaEmail === 0) {
			$verificaSenha = password_verify($senha,$Usuario['senha']);
			if ($verificaSenha) {
				$_SESSION['id_usuario'] = $Usuario['id_usuario'];
				$_SESSION['nome'] = $Usuario['nome'];

				$res = 'true';
			}
			else {
				$res = 'wrong_password';
				session_destroy();
			}
		} else {
			$res = 'wrong_user_found';
			session_destroy();
		}
	}

	$result['res'] = $res;
	$result['id_usuario'] = $_SESSION['id_usuario'];

	echo json_encode($result);
?>