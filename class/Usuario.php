<?php 

class Usuario{
	//atributos constantes na tabela tb_usuarios
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
	

	//getters e setters para cada um dos atributos.
	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		$this->idusuario = $value;
	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($value){
		$this->deslogin = $value;
	}
	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($value){
		$this->dessenha = $value;
	}
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}
	

	public function carregarPorId($id){
		$sql = new Sql();
		$rs = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id)); //não está funcionando por alguma razão desconhecida... o array associativo parece estar ok, certo?
		//$rs = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = $id", array(':ID'=>$id)); //tive que colocar o parâmetro direto no texto e o array enviado junto é inútil neste caso. Mas funciona!

		//retornará um array de arrays com todos os dados selecionados.
		if(count($rs) > 0){
		//if(isset($rs[0])){ //validar se há registros. Também poderia ser feito um if(count($rs) > 0)
			$this->setDados($rs[0]); 
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y")
		));
	}

	public static function getLista(){ //usando o estático não precisaremos estanciar este objeto
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	public static function procuraUsuario($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :PROCURADO ORDER BY idusuario", array(":PROCURADO"=>"%".$login."%"));

	}

	public function logar($login, $senha){
		$sql = new Sql();
		$rs = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
			":LOGIN"=>$login,
			":SENHA"=>$senha
		)); //
		if(count($rs) > 0){
			$this->setDados($rs[0]); 
		}else{
			throw new Exception("Login/senha inválidos");
		}
	}

	public function setDados($dados){
		$this->setIdusuario($dados['idusuario']);
		$this->setDeslogin($dados['deslogin']);
		$this->setDessenha($dados['dessenha']);
		$this->setDtcadastro(new DateTime($dados['dtcadastro']));
	}

	public function inserir(){
		$sql = new Sql();
		$rs = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)",array(
			':LOGIN'=>$this->getDeslogin(),
			':SENHA'=>$this->getDessenha()
		));
		if(count($rs) > 0){
			$this->setDados($rs[0]);
		}
	}

	public function atualizar($login, $senha){
		$this->setDeslogin($login);
		$this->setDessenha($senha);
		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASS WHERE idusuario = :ID", array(
			':LOGIN' => $this->getDeslogin(), 
			':PASS' => $this->getDessenha(),
			':ID' => $this->getIdusuario()
		));
	}

}

 ?>