<?php

require_once "../config.php";

$id= $_POST['id'];
$nome= addslashes($_POST['nome']);
$sexo= $_POST['sexo'];
$nascimento= $_POST['nascimento'];
$rua= $_POST['rua'];
$numero= addslashes($_POST['numero']);
$cidade= $_POST['cidade'];
$estado= $_POST['estado'];
$cpf= addslashes($_POST['cpf']);
$email= $_POST['email'];
$senha= addslashes($_POST['senha']);

$action = $_POST['action'];

$Item = new Usuario();
$Item->SetValues($id, $nome, $sexo, $nascimento, $rua, $numero, $cidade, $estado, $cpf, $email, password_hash($senha, PASSWORD_DEFAULT));

switch($action){
	case 'create':
	// Executa ação em tempo aleatório entre 0 e 3 segundos
	// e diminui a possibilidade de conflitos
	sleep(rand(0,3));

	$res = $Item->Create();
	$res = json_decode($res);

	if($res->{'result'} === NULL){
		$result['res'] = "true";
	}else{
		$result['res'] = "false";
	}

	// $result['id_usuario'] = $res->{'lastId'};
	$result['id'] = $res->{'lastId'};

	echo json_encode($result);
	break;

	case 'update':
	$res = $Item->Update();

	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;

	case 'delete':

	$res = $Item->Delete();
	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;


	case 'updateSenha':
	$res = $Item->UpdateSenha();
	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;

	case 'cripto':
		$Usuario = new Usuario();
  		$Usuario = $Usuario->Read($_POST['id']);
  		$senha_temp = $Usuario['senha'];

		if (password_verify($senha, $senha_temp)) {
			$res = "true";
		} else {
			$res = "false";
		}
		echo $res;

	break;
}
?>