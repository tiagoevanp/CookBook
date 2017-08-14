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
		<a href="logout.php">Sair</a> <br> <br> <br>
		<a href="nova_receita.php">Adicionar nova receita</a> <br> <br> <br>
		<a href="deletar_usuario.php">Excluir minha conta</a>
	</div>

	<?php
			$receitas = mysqli_query($link, "SELECT id, nome_receita, autor, ingredientes, receita FROM receitas");
			
			$convert = mysqli_fetch_assoc($receitas);
		if(!$convert){
		}
		else{
			do{
				echo "<div class='post'><h2>".$convert['nome_receita']."</h2><br><h3>".$convert['autor']."</h3><br><h4>Ingredientes:</h4><p>".$convert['ingredientes']."</p><br><h4>Receita:</h4><p>".$convert['receita']."</p><br><center><a href='deletar_receita.php?id=".$convert['id']."'>Excluir receita</a></center></div>";
			} while($convert = mysqli_fetch_assoc($receitas));
		} ;
	?>	
	
	
</body>

</html>