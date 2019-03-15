<?php
	class Usuario{
		private $id;
		private $nome;
		private $sexo;
		private $nascimento;
		private $rua;
		private $numero;
		private $cidade;
		private $estado;
		private $cpf;
		private $email;
		private $senha;

		//setters
		public function SetValues($id, $nome, $sexo, $nascimento, $rua, $numero, $cidade, $estado, $cpf, $email, $senha){
			$this->id = $id;
			$this->nome = $nome;
			$this->sexo = $sexo;
			$this->nascimento = $nascimento;
			$this->rua = $rua;
			$this->numero = $numero;
			$this->cidade = $cidade;
			$this->estado = $estado;
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
						sexo,
						nascimento,
						rua,
						numero,
						cidade,
						estado,
						cpf,
						email,
						senha
					)
				VALUES
					(
						'$this->id',
						'$this->nome',
						'$this->sexo',
						'$this->nascimento',
						'$this->rua',
						'$this->numero',
						'$this->cidade',
						'$this->estado',
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

		public function Update(){
			$sql = "
				UPDATE usuario SET

					nome = '$this->nome',
					sexo = '$this->sexo',
					nascimento = '$this->nascimento',
					rua = '$this->rua',
					numero = '$this->numero',
					cidade = '$this->cidade',
					estado = '$this->estado',
					cpf = '$this->cpf',
					email = '$this->email',
					senha = '$this->senha',
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
			$this->sexo;
			$this->nascimento;
			$this->rua;
			$this->numero;
			$this->cidade;
			$this->estado;
			$this->cpf;
			$this->email;
			$this->senha;
		}

		function __destruct(){
			$this->id;
			$this->nome;
			$this->sexo;
			$this->nascimento;
			$this->rua;
			$this->numero;
			$this->cidade;
			$this->estado;
			$this->cpf;
			$this->email;
			$this->senha;
		}
	};
?>
