<!DOCTYPE html>

<?php
	include "sql_connect.php";
	include "sql_session.php";
?>

<html>

<head>
	<meta charset="utf-8">
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