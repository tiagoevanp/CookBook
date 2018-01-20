<nav id="navReceita" class="navbar navbar-expand-lg">
	<div class="collapse navbar-collapse">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<?php
					$idReceita = $_GET['id'];
					echo "<a class='nav-link' href='nova_receita.php?id=$idReceita' id='editar'><p class='fa fa-pencil-square-o'></p>Editar</a>";
					echo "</li>";
					echo "<li class='nav-item dropdown'>";
					echo "<a class='nav-link' href='sistema/eventos/deletar_receita.php?id=$idReceita' id='excluir'><p class='fa fa-trash-o'></p>Excluir</a>";
				?>
			</li>
		</ul>
	</div>
</nav>