<!DOCTYPE html>

<?php
	include "sistema/sql_connect.php";
	include "sistema/sql_session.php";
?>

<html>

<head>
	<meta charset="utf-8">	
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<title>Meu livro de Receitas</title>

</head>

<?php  	
	if (isset($_GET['id'])) {
		$sqlEdicao = mysqli_query($link, "SELECT * FROM receitas WHERE id =" . $_GET['id']);
		$edicao = mysqli_fetch_assoc($sqlEdicao);
	}
?>

<body>
	
	<div>
		<h1>Meu livro de receitas</h1>
		<p>O seu livro de receitas web.</p>
		<a href="painel.php">Voltar para página de receitas</a> <br> <br> <br>
		<form id="receitanova" method="post" action="" >
			<input type="text" name="nome_receita" required="" placeholder="Nome da receita:" value="<?php if (isset($_GET['id'])){echo $edicao['nome_receita'];};?>">
			<input type="text" name="autor" required="" placeholder="Autor da receita:" value="<?php if (isset($_GET['id'])){echo $edicao['autor'];}?>">
			<textarea name="ingredientes" required="" placeholder="Escreva seus ingredientes:"><?php if (isset($_GET['id'])){echo $edicao['ingredientes'];}?></textarea>
			<textarea name="receita" required="" placeholder="Escreva sua receita:"><?php if (isset($_GET['id'])){echo $edicao['receita'];}?></textarea>
			<input class="button" type="submit" name="submeter" value="Adicionar">
		</form>
	</div>

	<?php
		
		if (isset($_POST['nome_receita']) && isset($_POST['autor']) &&isset($_POST['ingredientes']) && isset($_POST['receita'])) {
			$nome_receita = $_POST['nome_receita'];
			$autor = $_POST['autor'];
			$ingredientes = $_POST['ingredientes'];
			$receita = $_POST['receita'];

			$sessionQuery = $_SESSION['login'];
			$pessoaIdQuery = mysqli_query($link, "SELECT pessoaid FROM usuarios WHERE login = '$sessionQuery'");
			$pessoaId = mysqli_fetch_row($pessoaIdQuery);
			
			if (isset($_GET['id'])){
				$sql = mysqli_query($link, "UPDATE receitas SET nome_receita = '$nome_receita', autor = '$autor', ingredientes = '$ingredientes', receita = '$receita', pessoaid = '$pessoaId[0]' WHERE id = " . $_GET['id']);
				var_dump($sql);
			}
			else{
				$sql = mysqli_query($link, "INSERT INTO receitas (nome_receita, autor, ingredientes, receita, pessoaid) VALUES ('$nome_receita', '$autor', '$ingredientes', '$receita', '$pessoaId[0]')");
			}
			
			header('Location: painel.php');
		}
	?>
	
</body>

</html>