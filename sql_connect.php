<?php
		
	// criando conexão com o banco de dados
		
	$host = "localhost";
	$user = "root";
	$pass = "";
	$banco = "meu_livro_de_receitas";
	$link = mysqli_connect($host, $user, $pass, $banco);
		
	// conferindo status da conexão
		
	if (!$link){
  		die("Erro de conexão: " . mysqli_connect_error());
	};
?>