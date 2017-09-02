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