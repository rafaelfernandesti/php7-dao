<?php 

require_once("config.php");


//Primeiro teste
//$sql = new Sql();
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);


//Segundo teste com classe Usuario

$usuario = new Usuario();
$usuario->carregarPorId(1);
echo $usuario;
 ?>