<?php
	include 'sistema/construcao/cabecalho.php';
	include "sistema/sql/page_functions.php";
	include 'sistema/sql/sql_connect.php';
	include 'sistema/sql/sql_session.php';
?>

<body>
	<?php
		include 'sistema/construcao/navbar.php';
		$usuario = user($link);
		$buscarReceita = procurarReceitas($link);
	?>
	
	<div id="conteudo" class='jumbotron container'>
		<div class="row mb-5 justify-content-md-center">
			<p class="lead"><?php echo "A pesquisa por <em class='cor'>\"" . $_POST['pesquisa'] . "\"</em> retornou " . count($buscarReceita) . " resultado(s):" ?></p>
		</div>
		<div class="row mb-5">
			<?php
				if (!$buscarReceita){
					echo '<p>Nenhuma receita foi encontrada.</p>';
				}
				else{
					if ($_POST['pesquisa'] === "") {
						header('Location: painel.php');
					}
					else {
					 	foreach ($buscarReceita as $value) {
					 		$telaPesquisaReceitas =  "<div class='text-center col-sm-4'>
																	<div class='card'>
																	<a class='painel-link' href='receita.php?id=" . $value[0] . "'>";
							if (file_exists('usuarios/' . $usuario['id'] . '/imagens/' . $value[0] . 'croped.jpg')) {
								$telaPesquisaReceitas .=	"<img class='rounded img-card' src='usuarios/" . $usuario['id'] . "/imagens/" . $value[0] . "croped.jpg'>";
							}
							else {
								$telaPesquisaReceitas .= "<img class='rounded img-card' src='imagens/semfoto.jpg'>";
							}
							
							$enfase = "<em class='cor'>" . $_POST['pesquisa'] . '</em>';
							$telaPesquisaReceitas .=	"<h3 class='card-text'>" . $value[1] . "</h3>
															</a>
														</div>
													</div>";
							echo $telaPesquisaReceitas;
						}
					}
				}
			?>
		</div>
	</div>
	
	<?php
		include 'sistema/construcao/rodape.php'
	?>

</body>

</html>