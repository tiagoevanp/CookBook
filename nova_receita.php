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
	
	<div>
		<h1>Meu livro de receitas</h1>
		<p>O seu livro de receitas web.</p>
		<a href="painel.php">Voltar para página de receitas</a> <br> <br> <br>
		<form id="receitanova" method="post" action="acrescentar_receita.php" >
			<input type="text" name="nome_receita" required="" placeholder="Nome da receita:">
			<input type="text" name="autor" required="" placeholder="Autor da receita:">
			<textarea name="ingredientes" required="" placeholder="Escreva seus ingredientes:"></textarea>
			<textarea name="receita" required="" placeholder="Escreva sua receita:"></textarea>
			<input class="button" type="submit" name="submeter" value="Adicionar">
		</form>
	</div>
'
</body>

</html>