<?php

require_once "../config.php";

$id= $_POST['id'];
$nome= addslashes($_POST['nome']);
$quantidade= $_POST['quantidade'];
$tipo= $_POST['tipo']; 
$fk_usuario= $_POST['fk_usuario']; 

$action = $_POST['action'];

$Item = new Produto();
$Item->SetValues($id, $nome, $quantidade, $tipo, $fk_usuario);

switch($action){
	case 'create':

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