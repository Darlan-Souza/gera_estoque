<?php

require_once "../config.php";

$id= $_POST['id'];
$nome_produto= addslashes($_POST['nome_produto']);
$quantidade= $_POST['quantidade'];
$tipo_produto= $_POST['tipo_produto']; 

$action = $_POST['action'];

$Item = new Produto();
$Item->SetValues($id, $nome_produto, $quantidade, $tipo_produto);

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
}
?>