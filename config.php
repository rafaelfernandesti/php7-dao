<?php 

spl_autoload_register(function($nomeClasse){
	$nomeArquivo = "class".DIRECTORY_SEPARATOR.$nomeClasse.".php";
	if(file_exists(($nomeArquivo))){
		require_once($nomeArquivo);
	}

});

 ?>