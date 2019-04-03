<?php
class Produto{
	private $id;
	private $nome;
	private $quantidade;
	private $tipo;
	private $fk_usuario;

		//setters
	public function SetValues($id, $nome, $quantidade, $tipo, $fk_usuario){
		$this->id = $id;
		$this->nome = $nome;
		$this->quantidade = $quantidade;
		$this->tipo = $tipo;
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
		'$this->nome',
		'$this->quantidade',
		'$this->tipo'
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

		nome = '$this->nome',
		quantidade = '$this->quantidade',
		tipo = '$this->tipo'
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

	public function ReadAll_FK($id) {
			$sql = "
				SELECT *
				FROM
					produto AS t1
				where fk_usuario = '$id'
			";
			
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

	public function Pesq($id, $pesq) {
			$sql = "
			SELECT * FROM produto AS t1
				WHERE t1.nome LIKE '%$pesq%' AND fk_usuario = '$id'
			";

			$DB = new DB();
			$DB->open();
			$Data = $DB->fetchData($sql);
			$realData;
			if($Data ==NULL){
				$realData = $Data;
			}else{
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
		$this->nome;
		$this->quantidade;
		$this->tipo;
		$this->fk_usuario;
	}

	function __destruct(){
		$this->id;
		$this->nome;
		$this->quantidade;
		$this->tipo;
		$this->fk_usuario;
	}
};
?>