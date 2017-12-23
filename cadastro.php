<!DOCTYPE html>
	
	<?php
		include "sistema/sql_connect.php";
		session_start();
	?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<title>Receitas Culinárias</title>
</head>

<body>
	<div>
		<h1>Meu Livro de Receitas</h1>
	</div>

	<div>
		<h2>CADASTRO:</h2>
		<p>Realize o seu cadastro para acessar o livro de receitas.</p>

		<?php

			// Confere se já está aberto alguma sessão e redireciona para painel

			if (isset($_SESSION['login']) && isset($_SESSION['senha'])){
				
				header('Location: painel.php');
			
			}

			if(isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['login']) && isset($_POST['senha'])){
				
				$nome = $_POST['nome'];
				$sobrenome = $_POST['sobrenome'];
				$login = $_POST['login'];
				$senha = $_POST['senha'];

				// Cria um id específico para uso interno em conjunto com a sessão

				$sqlUltimoPessoaId = mysqli_query($link,"SELECT pessoaid FROM usuarios ORDER BY pessoaid DESC LIMIT 1");
				$conversor = mysqli_fetch_row($sqlUltimoPessoaId);

				if($conversor[0] === ""){
					$pessoaId = 1;
				}
				else{
					$pessoaId = $conversor[0] + 1;
				}

				// Verifica se já consta nome ou login no banco de dados
				
				$nomeduplicata = mysqli_query($link,"SELECT * FROM usuarios WHERE nome = '$nome' AND sobrenome = '$sobrenome'");
				$loginduplicata = mysqli_query($link, "SELECT * FROM usuarios WHERE login = '$login'");		
			
				if (mysqli_num_rows($nomeduplicata) > 0){
					echo "<p style='font-size:24px; color:red'>Nome de usuário já cadastrado!</p>";
				}

				else if (mysqli_num_rows($loginduplicata) > 0) {
					echo "<p style='font-size:24px; color:red'>Login invalido ou já existente!</p>";
				}

				// Verifica se o login e senha contêm mais de 6 digitos;

				elseif (strlen($login) < 6){
					echo "<p style='font-size:24px; color:red'>Login deve ter no minimo 6 caracteres!</p>";
				}

				elseif (strlen($senha) < 6){
					echo "<p style='font-size:24px; color:red'>Senha deve ter no minimo 6 caracteres!</p>";
				}				

				else {
					mysqli_query($link, "INSERT INTO usuarios (nome, sobrenome, login, senha, pessoaid) VALUES('$nome', '$sobrenome', '$login', '$senha', '$pessoaId')");
					header("Location: index.php");
				};

				
			}
			
			else{};

		?>

		<form name="cadastrar" method="post" action="">
			<input type="text" name="nome" placeholder="Nome:" required="">
			<input type="text" name="sobrenome" placeholder="Sobrenome:" required="">
			<input type="text" name="login" placeholder="Login:" required="" >
			<input type="password" name="senha" placeholder="Senha:" required="">
			<input class="button" type="submit" value="Cadastrar">
		</form>
		<br><br>
		<a href="index.php">Já possui cadastro?</a>
	</div>
</body>

</html>