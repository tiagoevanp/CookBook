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
			?>
			<div class="row border border-receita rounded row-receita">
				<div id="col-receita" class="col">
					<?php
						$idReceita = $_GET['id'];
						
						$criteria = new criteria();
						$criteria->addCondition('id',$idReceita);
						$receita = sqlFetchAssoc($link, $criteria, 'receitas');

						echo "<h1 class='display-5'>" . $receita['nome_receita'] . "</h1>
									<p class='italico'>" . $receita['autor'] . "</p>
									<h6 class='lead'><em class='marca-texto'>Ingredientes:</em></h6>
									<p>" . $receita['ingredientes'] . "</p>
									<h6 class='lead'><em class='marca-texto'>Preparo:</em></h6>
									<p>" . $receita['receita'] . "</p>";
					?>
				</div>
				<div class="col align-self-center text-center">
				
				
				<a data-toggle="popover" data-placement="left" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">
				<?php
					$usuario = user($link);
					if (file_exists("usuarios/" . $usuario['id'] . "/imagens/" . $idReceita . "croped.jpg")) {
						echo "<img class='rounded img-receita' src='usuarios/" . $usuario['id'] . "/imagens/" . $idReceita . "croped.jpg'>";
					}
					else {
						echo "<img class='rounded img-receita' src='imagens/semfoto.jpg'>";
					}
				?>	
				</a>
				<script type="text/javascript">
					$(function () {   
  					$('[data-toggle="popover"]').popover() 
					});
				</script>	

				</div>
			</div>
		</div>
	</div>

	<?php
		include 'sistema/construcao/rodape.php'
	?>