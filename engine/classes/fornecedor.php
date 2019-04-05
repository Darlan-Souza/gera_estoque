<?php
class Fornecedor{
	private $id;
	private $nome;
	private $cnpj;
	private $email;

		//setters
	public function SetValues($id, $nome, $cnpj, $email){
		$this->id = $id;
		$this->nome = $nome;
		$this->cnpj = $cnpj;
		$this->email = $email;
	}

	public function Create(){
		$sql = "
		INSERT INTO fornecedor
		(
		id,
		nome,
		cnpj,
		email
		)
		VALUES
		(
		'$this->id',
		'$this->nome',
		'$this->cnpj',
		'$this->email'
		);
		";

		$DB = new DB();
		$DB->open();
			// $result = $DB->query($sql);
			// $DB->close();
			// return $result;
		$result['result'] = $DB->query($sql);
		$result['lastId'] = $DB->lastId();
		$DB->close();
		return json_encode($result);
	}

	public function Read($id) {
		$sql = "
		SELECT * FROM fornecedor WHERE id  = '$id'
		";

		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);

		$DB->close();
		return $Data[0];
	}

	public function ReadAll(){
		$sql = "SELECT *FROM fornecedor";
		
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

	public function ReadSelect(){
		$sql = "SELECT * FROM fornecedor
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


	public function Update(){
		$sql = "
		UPDATE fornecedor SET
		nome = '$this->nome',
		cnpj = '$this->cnpj',
		email = '$this->email'
		
		WHERE id = '$this->id'
		";

		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}

	public function Delete(){
		$sql = "
		DELETE FROM fornecedor	WHERE id = '$this->id'
		";

		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}

	function __construct(){
		$this->id;
		$this->nome;
		$this->cnpj;
		$this->email;
		$this->senha;
	}

	function __destruct(){
		$this->id;
		$this->nome;
		$this->cnpj;
		$this->email;
		$this->senha;
	}
};
?>
