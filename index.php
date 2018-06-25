<?php
	include "sistema/construcao/cabecalho.php";
	include "sistema/sql/page_functions.php";
	include 'sistema/sql/sql_connect.php';
	session_start();
?>

<body>
	<div id="top" class="jumbotron">
		<div class="container">
			<div class="media">
				<img class="w-25 h-25" src="imagens/logo.png">
				<div class="media-body align-self-center text-center">
					<h1 class="display-2">CookBook.com.br</h1>
					<p class="lead">O seu livro de receitas</p>
				</div>
			</div>
		</div>
	</div>

	<div id="conteudo" class="jumbotron">
		<div class="row">
			<div class="col-sm">
				<h1 class="display-4">O que significa CookBook?</h1>
				<p class="lead">CookBook traduzido do inglês significa livro de receitas. CookBook.com.br nada mais é do que um site fácil e simples de ser utilizado para guardar receitas.</p>
			</div>
			
			<div class="col-sm">
				<h1 class="display-4">Login:</h1>
				<p class="lead">Digite seu login e senha para acessar suas receitas:</p>
				
				<?php
									
					if (isset($_SESSION['login']) && isset($_SESSION['senha'])){
						header('Location: painel.php');
					}

					if(isset($_POST['login_acesso']) && isset($_POST['senha_acesso'])){
						loginCheck($link);
					}

					if(isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['login']) && isset($_POST['senha'])){	
						duplicataCheck($link);
					}
				?>

				<form name="logar" method="post" action="">
					<div class="form-group">
						<label for="login">Login de Acesso</label>
						<input id="login" class="form-control" type="text" name="login_acesso" placeholder="Login:">
					</div>
					<div class="form-group">
						<label for="senha">Senha de Acesso</label>
						<input id="senha" class="form-control" type="password" name="senha_acesso" placeholder="Senha:">
					</div>
					<div>
						<input name="button" class="btn btn-block btn-principal" type="submit" value="Acessar">
					</div>
				</form>
				
				<br>
				
				<button type="button" class="btn btn-block btn-principal" data-toggle="modal" data-target="#modal_cadastro">Realizar Cadastro</button>
								
				<div class="modal fade" id="modal_cadastro">
					<div class="modal-dialog">
    					<div id="modal" class="modal-content">
    						<div class="modal-header">
									<h2 class="modal-title">Cadastro:</h2>
								</div>

								<div class="modal-body">
									<p class="lead">Realize o seu cadastro para acessar o livro de receitas.</p>
									<form name="cadastrar" method="post" action="">
										<div class="form-group">
											<label for="nome">Seu primeiro nome</label>
											<input class="form-control" id="nome" type="text" name="nome" placeholder="Nome:" required="">
										</div>
										<div class="form-group">
											<label for="sobrenome">Seu sobrenome completo</label>
											<input class="form-control" id="sobrenome" type="text" name="sobrenome" placeholder="Sobrenome:" required="">
										</div>
										<div class="form-group">
											<label for="login_cadastro">Nome de acesso (Mínimo 6 caractéres)</label>
											<input class="form-control" id="login_cadastro" type="text" name="login" placeholder="Login:" required="" >
										</div>
										<div class="form-group">
											<label for="senha_cadastro">Senha de acesso (Mínimo 6 caractéres)</label>
											<input class="form-control" id="senha_cadastro" type="password" name="senha" placeholder="Senha:" required="">
										</div>
										
										<input class="btn btn-block btn-principal" type="submit" value="Cadastrar">
									</form>
								
								<br>
								
								<button type="button" class="btn btn-block btn-secundario" data-dismiss="modal">Cancelar Cadastro</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		include 'sistema/construcao/rodape.php'
	?>
</body>

</html>