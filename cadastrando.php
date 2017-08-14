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

<html>

<head>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Cadastrando</title>

	<script type="text/javascript">
		
		function sucesso(){
			setTimeout("window.location='index.html'", 3000);
		}
		
		function falha(){
			setTimeout("window.location='cadastro.html'", 3000);
		}

	</script>

</head>

<body>

	<?php

		// ajustando valores as variáveis
		
		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		
		// verificando se já existe cadastro
		
		$nomeduplicata = mysqli_query($link,"SELECT * FROM usuarios WHERE nome = '$nome' AND sobrenome = '$sobrenome'");
		$loginduplicata = mysqli_query($link, "SELECT * FROM usuarios WHERE login = '$login'");		
		

		if (mysqli_num_rows($nomeduplicata) > 0){
			echo "<div><center><h1>Nome de usuário já cadastrado!</h1><center></div>";
			echo "<script> falha() </script>";
		}

		else if (mysqli_num_rows($loginduplicata) > 0) {
			echo "<div><center><h1>Login invalido ou já existente!</h1></center></div>";
			echo "<script> falha() </script>";
		}

		// inserindo cadastro na tabela

		else {
			mysqli_query($link, "INSERT INTO usuarios (nome, sobrenome, login, senha) VALUES('$nome', '$sobrenome', '$login', '$senha')");
			echo "<div><center><h1>Você criou um novo cadastro com sucesso!</h1></center></div>";
			echo "<script> sucesso() </script>";
		};
	?>
</body>

</html>