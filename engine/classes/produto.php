<?php
class Produto{
	private $id;
	private $nome_produto;
	private $quantidade;
	private $tipo_produto;
	private $fk_usuario;

		//setters
	public function SetValues($id, $nome_produto, $quantidade, $tipo_produto, $fk_usuario){
		$this->id = $id;
		$this->nome_produto = $nome_produto;
		$this->quantidade = $quantidade;
		$this->tipo_produto = $tipo_produto;
		$this->fk_usuario = $fk_usuario;
	}

	public function Create(){
		$sql = "
		INSERT INTO produto
		(
		id,
		fk_usuario,
		nome,
		quantidade,
		tipo
		)
		VALUES
		(
		'$this->id',
		'$this->fk_usuario',
		'$this->nome_produto',
		'$this->quantidade',
		'$this->tipo_produto'
		);
		";

			$DB = new DB();
			$DB->open();
			$result = $DB->query($sql);
			$DB->close();
			return json_encode($result);
	}
	public function Update(){
		$sql = "
		UPDATE produto SET

		nome_produto = '$this->nome_produto',
		quantidade = '$this->quantidade',
		tipo_produto = '$this->tipo_produto',
		fk_usuario = '$this-> fk_usuario',
		WHERE id = '$this->id'
		";

		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}

	public function Read_fk($id) {
		$sql = "
		SELECT * FROM produto WHERE fk_usuario  = '$id'
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);

		$DB->close();
		return $Data[0];
	}

	public function Read($id){
			$sql = "
				SELECT *
				FROM
					produto AS t1
				WHERE
					t1.id = '$id'
				";

			$DB = new DB();
			$DB->open();
			$Data = $DB->fetchData($sql);
			$DB->close();
			return $Data[0];
		}

	public function ReadAll(){
		$sql = "SELECT *FROM produto";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);
		$realData;
		if($Data ==NULL){
			$realData = $Data;
		}
		else{
			foreach($Data as $itemData){
				if(is_bool($itemData)) continue;
				else{
					$realData[] = $itemData;
				}
			}
		}
		$DB->close();
		return $realData;
	}

	public function Delete(){
		$sql = "DELETE FROM produto	WHERE id = '$this->id'";

		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}

	function __construct(){
		$this->id;
		$this->nome_produto;
		$this->quantidade;
		$this->tipo_produto;
		$this->fk_usuario;
	}

	function __destruct(){
		$this->id;
		$this->nome_produto;
		$this->quantidade;
		$this->tipo_produto;
		$this->fk_usuario;
	}
};
?>