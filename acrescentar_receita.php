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
	<title>Meu livro de Receitas</title>

</head>

<body>
	
	<?php
		$nome_receita = $_POST['nome_receita'];
		$autor = $_POST['autor'];
		$ingredientes = $_POST['ingredientes'];
		$receita = $_POST['receita'];

		$sql = mysqli_query($link, "INSERT INTO receitas (nome_receita, autor, ingredientes, receita) VALUES ('$nome_receita', '$autor', '$ingredientes', '$receita')");
		header('Location: painel.php');
	?>

</body>

</html>