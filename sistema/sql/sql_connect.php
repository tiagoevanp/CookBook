<?php
	$host = "localhost";
	$user = "phpmyadmin";
	$pass = "39907200";
	$banco = "meu_livro_de_receitas";
	
	$link = mysqli_connect($host, $user, $pass, $banco);
	
	if (!$link){
		die("Erro de conexão: " . mysqli_connect_error());
	};
		
