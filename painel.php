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

<body>
	
	<div>
		<h1>Meu livro de receitas</h1>
		<p>O seu livro de receitas web.</p>
		
		<?php
			
			// Nome do usuário logado na página

			$nomeQuery = mysqli_query($link, "SELECT nome FROM usuarios WHERE login = '$_SESSION[login]'");
			$nome = mysqli_fetch_row($nomeQuery);
			echo "<p style='font-weight: bold'>Logado a partir de $nome[0]</p>";

		?>
		
		<a href="sistema/logout.php">Sair</a> <br> <br> <br>
		<a href="nova_receita.php">Adicionar nova receita</a> <br> <br> <br>
		<a href='sistema/deletar_usuario.php'>Excluir minha conta</a>
			
	</div>

	<?php
			$session = $_SESSION['login'];
			$pessoaId = mysqli_query($link, "SELECT pessoaid FROM usuarios WHERE login = '$session'");
			$convertPessoaId = mysqli_fetch_row($pessoaId);

			$receitas = mysqli_query($link, "SELECT id, nome_receita, autor, ingredientes, receita FROM receitas WHERE pessoaid = '$convertPessoaId[0]' ORDER BY nome_receita");
			
			$convert = mysqli_fetch_assoc($receitas);
		if(!$convert){
		}
		else{
			do{
				echo "<div class='post'><h2>" . $convert['nome_receita'] . "</h2><br><h3>" . $convert['autor'] . "</h3><br><h4>Ingredientes:</h4><p>" . nl2br($convert['ingredientes']) . "</p><br><h4>Receita:</h4><p>" . nl2br($convert['receita']) . "</p><center><br><a href='nova_receita.php?id=" . $convert['id'] . "'>Editar Receita</a><br><br><a href='sistema/deletar_receita.php?id=" . $convert['id'] . "'>Excluir receita</a></center></div>";
			} while($convert = mysqli_fetch_assoc($receitas));
		} ;
	?>	
	
	
</body>

</html>