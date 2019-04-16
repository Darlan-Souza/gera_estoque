<?php
class Redefinicao_senha {
	private $id;
	private $cpf;
	private $email;
	private $status;

		//Funcao que seta uma instancia da classe
	public function SetValues($id, , $cpf, $email, $status) { 
		$this->id = $id;
		$this-> = ;
		$this->cpf = $cpf;
		$this->email = $email;
		$this->status = $status;
	}

	public function Create() {
		
		$sql = "
		INSERT INTO redefinicao_senha
		(
		id,
		,
		cpf,
		email,
		status,
		dateTime_acao
		)
		VALUES
		(
		'$this->id',
		'$this->',
		'$this->cpf',
		'$this->email',
		'$this->status',
		now()
		);
		";
		
		$DB = new DB();
		$DB->open();
		$result = $DB->query($sql);
		$DB->close();
		return $result;
	}
	
		//Funcao que retorna uma Instancia especifica da classe no bd
	public function ReadToken($token) {
		$sql = "
		SELECT * FROM redefinicao_senha WHERE   = '$token'";		
		
		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);
		
		$DB->close();
		return $Data[0]; 
	}
	
	
		//Funcao que retorna um vetor com todos as instancias da classe no BD
	public function ReadAll() {
		$sql = "
		SELECT
		t1.id,
		t1.,
		t1.cpf,
		t1.email,
		t1.status
		FROM
		redefinicao_senha AS t1
		

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
	
	
	
	
		//Funcao que retorna um vetor com todos as instancias da classe no BD com paginacao
	public function ReadAll_Paginacao($inicio, $registros) {
		$sql = "
		SELECT
		t1.id,
		t1.,
		t1.cpf,
		t1.email,
		t1.status
		FROM
		redefinicao_senha AS t1
		
		
		LIMIT $inicio, $registros;
		";
		
		
		$DB = new DB();
		$DB->open();
		$Data = $DB->fetchData($sql);
		
		$DB->close();
		return $Data; 
	}
	
		//Funcao que atualiza uma instancia no BD
	public function Update() {
		$sql = "
		UPDATE redefinicao_senha SET

		status = '1',
		dateTime_acao = now()
		
		WHERE cpf = '$this->cpf';
		
		";
		
		
		$DB = new DB();
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}
	
		//Funcao que deleta uma instancia no BD
	public function Delete() {
		$sql = "
		DELETE FROM redefinicao_senha
		WHERE email = '$this->email';
		";
		$DB = new DB();
		
		$DB->open();
		$result =$DB->query($sql);
		$DB->close();
		return $result;
	}
	
	
		/*
			--------------------------------------------------
			Viewer SPecific methods -- begin 
			--------------------------------------------------
		
		*/
			
			
		/*
			--------------------------------------------------
			Viewer SPecific methods -- end 
			--------------------------------------------------
		
		*/
			
			
		//constructor 
			
			function __construct() { 
				$this->id;
				$this->cpf;
				$this->email;
				
				
			}
			
		//destructor
			function __destruct() {
				$this->id;
				$this->cpf;
				$this->email;
				
				
			}
			
		};

		?>
