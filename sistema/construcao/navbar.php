<nav id="navbar" class="navbar navbar-expand-lg">
	<a class="navbar-brand" href="painel.php"><img width="60px" height="60px" class="" src="imagens/logo.png"></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbar" aria-controls="conteudoNavbar" aria-expanded="false">
  	<span class="navbar-toggler-icon"></span>
 	</button>
		
	<div class="collapse navbar-collapse" id="conteudoNavbar">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class='nav-link dropdown-toogle' href="#" id="receitas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Receitas</a>
				<div class="dropdown-menu" aria-labelledby="receitas">
          <a class="dropdown-item" href="nova_receita.php">Adicionar nova receita</a>
        </div>
			</li>
		</ul>
		<form class="form-inline mr-auto" method="post" action="pesquisa.php">
      <input id="pesquisa" class="form-control mr-sm-2" type="search" placeholder="Buscar Receitas" aria-label="Search" name="pesquisa">
      <button id="btnPesquisa" class="btn btn-outline" type="submit"><em class="fa fa-search"></em></button>
    </form>		
		<ul class="navbar-nav">
			<li class ='nav-item dropdown'>
				<a class='nav-link dropdown-toogle' href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php
					$usuario = user($link);
					echo $usuario['nome'];
				?>
				</a>
				
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="config.php">Configurações</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="sistema/eventos/logout.php">Sair</a>
        </div>
     	</li>
		</ul>
	</div>
</nav>