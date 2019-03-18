<?php
	class Produto{
		private $id;
		private $nome_produto;
		private $quantidade;
		private $tipo_produto;

		//setters
		public function SetValues($id, $nome_produto, $quantidade, $tipo_produto){
			$this->id = $id;
			$this->nome_produto = $nome_produto;
			$this->quantidade = $quantidade;
			$this->tipo_produto = $tipo_produto;
		}

		public function Create(){
			$sql = "
				INSERT INTO produto
					(
						id,
						nome_produto,
						quantidade,
						tipo_produto
					)
				VALUES
					(
						'$this->id',
						'$this->nome_produto',
						'$this->quantidade',
						'$this->tipo_produto'
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

		public function Update(){
			$sql = "
				UPDATE produto SET

					nome_produto = '$this->nome_produto',
					quantidade = '$this->quantidade',
					tipo_produto = '$this->tipo_produto',
					WHERE id = '$this->id'
				";

			$DB = new DB();
			$DB->open();
			$result =$DB->query($sql);
			$DB->close();
			return $result;
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
		}

		function __destruct(){
			$this->id;
			$this->nome_produto;
			$this->quantidade;
			$this->tipo_produto;
		}
	};
?>