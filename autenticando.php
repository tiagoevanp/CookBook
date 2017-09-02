<!DOCTYPE html>
	<meta charset="utf-8">
	<?php
		include "sql_connect.php";
  	?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Autenticando usuário</title>
	
	<script type="text/javascript">
		
		function sucesso(){
			setTimeout("window.location='painel.php'",3000);
		}

		function falha(){
			setTimeout("window.location='index.html'",3000);
		}
	</script>
</head>
<body>
	
	<?php
  		// confirmando se cadastrado na tabela;
		
		$login = $_POST['login_acesso'];
		$senha = $_POST['senha_acesso'];

		$loginsenha = mysqli_query($link, "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'");

		if(mysqli_num_rows($loginsenha) > 0){
			session_start();
			$_SESSION['login']=$_POST['login_acesso'];
			$_SESSION['senha']=$_POST['senha_acesso'];
			echo "<div><center><h1>Você foi autenticado com sucesso!</h1></center></div>";
			echo "<script> sucesso() </script>";
		}
		else{
			echo "<div><center><h1>Login ou senha incorreta!</h1></center></div>";
			echo "<script> falha() </script>";
		};
?>

</body>
</html>
