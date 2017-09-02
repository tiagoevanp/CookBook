<!DOCTYPE html>
	
	<?php
		include "sql_connect.php";
	?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
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
		
			if(isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['login']) && isset($_POST['senha'])){
				$nome = $_POST['nome'];
				$sobrenome = $_POST['sobrenome'];
				$login = $_POST['login'];
				$senha = $_POST['senha'];
			
				$nomeduplicata = mysqli_query($link,"SELECT * FROM usuarios WHERE nome = '$nome' AND sobrenome = '$sobrenome'");
				$loginduplicata = mysqli_query($link, "SELECT * FROM usuarios WHERE login = '$login'");		
			
				if (mysqli_num_rows($nomeduplicata) > 0){
					echo "<p style='font-size:24px; color:red'>Nome de usuário já cadastrado!</p>";
				}

				else if (mysqli_num_rows($loginduplicata) > 0) {
					echo "<p style='font-size:24px; color:red'>Login invalido ou já existente!</p>";
				}
		
				else {
					mysqli_query($link, "INSERT INTO usuarios (nome, sobrenome, login, senha) VALUES('$nome', '$sobrenome', '$login', '$senha')");
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