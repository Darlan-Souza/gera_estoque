<?php
	class Usuario{
		private $id;
		private $nome;
		private $cpf;
		private $email;
		private $senha;

		//setters
		public function SetValues($id, $nome, $cpf, $email, $senha){
			$this->id = $id;
			$this->nome = $nome;
			$this->cpf = $cpf;
			$this->email = $email;
			$this->senha = $senha;
		}

		public function Create(){
			$sql = "
				INSERT INTO usuario
					(
						id,
						nome,
						cpf,
						email,
						senha
					)
				VALUES
					(
						'$this->id',
						'$this->nome',
						'$this->cpf',
						'$this->email',
						'$this->senha'
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
				SELECT * FROM usuario WHERE id  = '$id'
			";

			$DB = new DB();
			$DB->open();
			$Data = $DB->fetchData($sql);

			$DB->close();
			return $Data[0];
		}

		public function ReadAll(){
			$sql = "SELECT *FROM usuario";
			
			$DB = new DB();
			$DB->open();
			$Data = $DB->fetchData($sql);

			$DB->close();
			return $Data[0];
		}

		public function Read_email($email){
			$sql = "
				SELECT * FROM usuario WHERE email = '$email' ";

			$DB = new DB();
			$DB->open();
			$Data = $DB->fetchData($sql);
			$DB->close();
			return $Data[0];
		}

		public function Update(){
			$sql = "
				UPDATE usuario SET
					nome = '$this->nome',
					cpf = '$this->cpf',
					email = '$this->email'
					
				WHERE id = '$this->id'
				";

			$DB = new DB();
			$DB->open();
			$result =$DB->query($sql);
			$DB->close();
			return $result;
		}

		public function UpdateSenha(){
			$sql = "
				UPDATE usuario SET

					senha = '$this->senha',
					updated_at = now()

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
				DELETE FROM usuario	WHERE id = '$this->id'
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
			$this->cpf;
			$this->email;
			$this->senha;
		}

		function __destruct(){
			$this->id;
			$this->nome;
			$this->cpf;
			$this->email;
			$this->senha;
		}
	};
?>
