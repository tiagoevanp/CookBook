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
	
	<div>
		<h1>Meu livro de receitas</h1>
		<p>O seu livro de receitas web.</p>
		<a href="painel.php">Voltar para página de receitas</a> <br> <br> <br>
		<form id="receitanova" method="post" action="" >
			<input type="text" name="nome_receita" required="" placeholder="Nome da receita:">
			<input type="text" name="autor" required="" placeholder="Autor da receita:">
			<textarea name="ingredientes" required="" placeholder="Escreva seus ingredientes:"></textarea>
			<textarea name="receita" required="" placeholder="Escreva sua receita:"></textarea>
			<input class="button" type="submit" name="submeter" value="Adicionar">
		</form>
	</div>

	<?php
		if (isset($_POST['nome_receita']) && isset($_POST['autor']) &&isset($_POST['ingredientes']) && isset($_POST['receita'])) {
			$nome_receita = $_POST['nome_receita'];
			$autor = $_POST['autor'];
			$ingredientes = $_POST['ingredientes'];
			$receita = $_POST['receita'];

			$sql = mysqli_query($link, "INSERT INTO receitas (nome_receita, autor, ingredientes, receita) VALUES ('$nome_receita', '$autor', '$ingredientes', '$receita')");
			header('Location: painel.php');
		}
		else{};
	?>
'
</body>

</html>