<!DOCTYPE html>

<meta charset="utf-8">
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
  	
  	<?php

  		// confirmando se sessão aberta
  		session_start();
  		if (!isset($_SESSION['login']) || !isset($_SESSION['senha'])) {
  			header('Location: index.html');
  			exit;
  		}
  	?>

<html>

<head>
	
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Deletanto Usuário</title>

</head>

<body>
	<?php
		echo "$_SESSION[login]";
		$delusuario = mysqli_query($link,"DELETE FROM usuarios WHERE login = '$_SESSION[login]'");
		header('Location: index.html');
	?>
</body>

</html>