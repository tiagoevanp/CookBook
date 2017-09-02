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