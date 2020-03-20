<?php 

require_once("config.php");


//Primeiro teste
//$sql = new Sql();
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);


//Segundo teste com classe Usuario para carregar um usuário apenas
//$usuario = new Usuario();
//$usuario->carregarPorId(1);
//echo $usuario;

//Terceiro teste carregando uma lista de usuários
//$lista = Usuario::getLista();
//print_r($lista);

//Quarto teste carregando lista de usuaários buscando login
//$busca = Usuario::procuraUsuario("ro");
//echo json_encode($busca);


//Quinto teste de login e senha válidos
$usuario = new Usuario();
$usuario->logar("root","12345");

echo $usuario;
 ?>