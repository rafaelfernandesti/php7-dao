<?php 
class Sql extends PDO{

	private $conexao;

	public function __construct(){
		$this->conexao = new PDO("mysql:host=localhost;dbname=dbphp7", "root","root");
	}

	private function setParams($statement, $parametros =array()){
		foreach($parametros as $key => $value){
				$this->setParam($key, $value);
		} //associação dos parâmetros
	}

	private function setParam($statement, $chave, $valor){
		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array()){ //$rawQuery = queryBruta ou comando SQL em si... os parametros serão uma array com os dados recebidos.
		$stmt = $this->conexao->prepare("$rawQuery");
		//criação do statement

		$this->setParams($stmt, $params);
		
		$stmt->execute();//executa a ação no BD

		return $stmt;

	}

	public function select($rawQuery, $params = array()):array{
		$stmt = $this->query($rawQuery,$params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}


 ?>