<?php
	include "sistema/construcao/cabecalho.php";
	include "sistema/sql/page_functions.php";
	include 'sistema/sql/sql_connect.php';
	include "sistema/sql/sql_session.php";
  	
	if (isset($_GET['id'])) {
		$edicao = editarReceita($link);
	}
?>

<body>
	<?php
		include 'sistema/construcao/navbar.php';
	?>

	<div id="conteudo" class="jumbotron">
		<?php
			if (isset($_POST['nome_receita']) && isset($_POST['autor']) &&isset($_POST['ingredientes']) && isset($_POST['receita'])) {
				if (!empty($id = $_GET['id'])){
					salvarReceitaEditada($link);
					header("Location: receita.php?id=$id" );
				}
				else {
					if (!empty($_FILES['foto']['name'])) {
						$extensão = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
						
						if (strstr('jpg; png; jpeg', $extensão)) {
							incluirReceita($link);
							
							$receita = selectReceita($link);
							$nome = $receita['id'] . '.jpg';
												
							if (move_uploaded_file($_FILES['foto']['tmp_name'], 'usuarios/' . $usuario['id'] . '/imagens/' . $nome)) {

								$img = imagecreatefromjpeg('usuarios/' . $usuario['id'] . '/imagens/' . $nome);
								$imgX = imagesx($img);
								$imgY = imagesy($img);
								$size = 200;
								$x = ($imgX/2) - ($size/2);
								$y = ($imgY/2) - ($size/2);
								$cropImg = imagecrop($img, ['x' => $x, 'y' => $y, 'width' => $size, 'height' => $size]);
								$newImg = imagejpeg($cropImg, 'usuarios/' . $usuario['id'] . '/imagens/' . $receitaId['id'] . 'croped.jpg');
								
								echo "<div class='alert alert-success'>Receita gravada com sucesso</div>";
							}
							else{
								echo "<div class='alert alert-danger'>Imagem não pode ser salvo</div>";
							}
						}
						else{
							echo "<div class='alert alert-danger'>A extensão da imagem deve ser .jpg ou .png</div>";
						}
					}
					else{
						incluirReceita($link);						
						echo "<div class='alert alert-success'>Receita gravada com sucesso</div>";	
					}
				}
			}
		?>
		
		<form enctype="multipart/form-data" id="receitanova" method="post" action="" >
			<div class="form-row mb-5">
				<div class="form-group col-sm-4 m-auto">
					<label for="nomeReceita">Nome da Receita:</label>
					<input id="nomeReceita" class="form-control" type="text" name="nome_receita" required="" value="<?php if (isset($_GET['id'])){echo $edicao['nome_receita'];};?>">
				</div>

				<div class="form-group col-sm-4 mb-5 m-auto">
					<label for="autorReceita">Autor da Receita:</label>
					<input id="autorReceita" class="form-control " type="text" name="autor" required="" value="<?php if (isset($_GET['id'])){echo $edicao['autor'];}?>">
				</div>
			</div>
			
			<div class="form-row mb-3">
				<div class="form-group col-sm-10 m-auto">
					<label for="ingredientes">Ingredientes:</label>
					<textarea id="ingredientes" class="form-control " name="ingredientes" required=""><?php if (isset($_GET['id'])){echo strip_tags($edicao['ingredientes']);}?></textarea>
				</div>
			</div>

			<div class="form-row mb-5">
				<div class="form-group col-sm-10 m-auto">
					<label for="preparo">Modo de preparo:</label>
					<textarea id="preparo" class="form-control" name="receita" required=""><?php if (isset($_GET['id'])){echo strip_tags($edicao['receita']);}?></textarea>
				</div>
			</div>

			<div class="form-row mb-5">
				<div class="form-group col-sm-10 m-auto">
					<label for="foto">Imagem da receita (Formato apenas em JPG ou PNG):</label>
					<input type="file" id="foto" class="form-control-file" name="foto"></input>
				</div>
			</div>

			<div class="form-row text-center">
				<div class="form-group col-sm-10 m-auto">
					<input class="btn btn-principal btn-lg btn-block" type="submit" name="submeter" value="Adicionar">
				</div>
			</div>
		</form>
	</div>

	<?php
		include 'sistema/construcao/rodape.php'
	?>	
</body>
</html>