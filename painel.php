<?php
	include 'sistema/construcao/cabecalho.php';
	include "sistema/sql/page_functions.php";
	include 'sistema/sql/sql_connect.php';
	include 'sistema/sql/sql_session.php';
?>

<body>
	<?php
		include 'sistema/construcao/navbar.php';
	?>
	
	<div id="conteudo" class='jumbotron container'>
		<div class="row mb-5 justify-content-md-center">
			<h1 class='display-4'>Minhas Receitas</h1>
		</div>
		<div class="row mb-5">
			<?php
								
				$usuario = user($link);				
				$receitas = selectReceitas($link);

				if (!$receitas){
					echo '<p>Você ainda não possui nenhuma receita.</p>';
				}
				else{
				 	foreach ($receitas as $value) {
				 		$telaReceitas =  "<div class='text-center col-sm-4'>
																<div class='card'>
																<a class='painel-link' href='receita.php?id=" . $value[0] . "'>";
						if (file_exists('usuarios/' . $usuario['id'] . '/imagens/' . $value[0] . 'croped.jpg')) {
							$telaReceitas .=	"<img class='rounded img-card' src='usuarios/" . $usuario['id'] . "/imagens/" . $value[0] . "croped.jpg'>";
						}
						else {
							$telaReceitas .= "<img class='rounded img-card' src='imagens/semfoto.jpg'>";
						}
						
						
						$telaReceitas .=	"<h3 class='card-text'>" . $value[1] . "</h3>
														</a>
													</div>
												</div>";
						echo $telaReceitas;
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