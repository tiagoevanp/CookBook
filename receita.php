<?php
	include "sistema/construcao/cabecalho.php";
	include "sistema/sql/sql_connect.php";
	include "sistema/sql/sql_session.php";
	include "sistema/sql/page_functions.php";
?>

<body>
	<?php
		include 'sistema/construcao/navbar.php';
	?>
	
	<div id="conteudo" class='jumbotron'>
		<div class="container">
			<?php
			include "sistema/construcao/navReceita.php";
				$idReceita = $_GET['id'];
				
				$criteria = new criteria();
				$criteria->addCondition('id',$idReceita);
				$receita = sqlFetchAssoc($link, $criteria, 'receitas');

				echo "<h1 class=''>" . $receita['nome_receita'] . "</h1>
							<p class='italico'>" . $receita['autor'] . "</p>
							<h6 class='lead'><em class='marca-texto'>Ingredientes:</em></h6>
							<p>" . $receita['ingredientes'] . "</p>
							<h6 class='lead'><em class='marca-texto'>Preparo:</em></h6>
							<p>" . $receita['receita'] . "</p>";
			?>
		</div>
	</div>

	<?php
		include 'sistema/construcao/rodape.php'
	?>