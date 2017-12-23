<!DOCTYPE html>
<html>
	<?php
		include "sistema/sql_connect.php";
		session_start();
  	?>
<head>
	
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<title>Login</title>

</head>

<body>

<div>
	
	<h1>Meu Livro de Receitas</h1>

</div>

<div>
	
	<h2>Login:</h2>
	<p>Digite seu login e senha para acessar suas receitas:</p>
	
	<?php

		// Confere se já está aberto alguma sessão e redireciona para painel
		
		if (isset($_SESSION['login']) && isset($_SESSION['senha'])){
			header('Location: painel.php');
		}

		if(isset($_POST['login_acesso']) && isset($_POST['senha_acesso'])){
			$login = $_POST['login_acesso'];
			$senha = $_POST['senha_acesso'];
			
			$loginsenha = mysqli_query($link, "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'");

			if(mysqli_num_rows($loginsenha) > 0){
				$_SESSION['login']=$_POST['login_acesso'];
				$_SESSION['senha']=$_POST['senha_acesso'];
				
				header('Location: painel.php');
			}
			else{
				echo "<p style='font-size:24px; color:red'>Login ou senha incorretos!</p>";
			};
		
		}
		else{}

	?>

	<form name="logar" method="post" action="">
		<input type="text" name="login_acesso" placeholder="Login:">
		<input type="password" name="senha_acesso" placeholder="Senha:">
		<input name="button" class="button" type="submit" value="Acessar">
	</form>
	
	<br><br><br><br>
	
	<a href="cadastro.php">Não possui login?</a>

</div>
</body>

</html>