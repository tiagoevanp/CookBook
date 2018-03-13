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
				if (!empty($_GET['id'])){
					$id = $_GET['id'];
					salvarReceitaEditada($link);
					header("Location: receita.php?id=$id" );
				}
				else {
					if (!empty($_FILES['foto']['name'])) {
						$extensão = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
						
						if (strstr('jpg; png; jpeg', $extensão)) {
							if (incluirReceita($link)){
								$usuario = user($link);
								$receita = selectReceita($link);
								$nome = $receita['id'];
								$extensao = '.jpg';	
							}
											
							if (move_uploaded_file($_FILES['foto']['tmp_name'], 'usuarios/' . $usuario['id'] . '/imagens/' . $nome . $extensao)) {
								echo "<div class='modal fade' id='modal_crop'>
												<div class='modal-dialog'>
						    					<div id='modal' class='modal-content'>
						    						<div class='modal-header'>
															<h2 class='modal-title'>Ajustar Corte da Foto</h2>
														</div>

														<div class='modal-body crop-modal-body text-center'>
															<p class='lead'>Selecione o corte na foto da receita.</p>
															<img id='image' src='usuarios/" . $usuario['id'] . "/imagens/" . $nome . $extensao . "'>
															<br>";
													echo "<button class='btn btn-principal btn-lg btn-block' onclick='getCanvas(" . $usuario['id'] . ", $nome)'>Cortar</button>";

													echo"<script type='text/javascript'>
																var image = document.getElementById('image');
																var cropper = new Cropper(image, {
																	aspectRatio: 4 / 4,
																	viewMode: 1,
																	dragMode: 'move',
																	guides: false,
																	center: false,
																	cropBoxMovable: false,
																	cropBoxResizable: false,
																	autoCropArea: 1
																});
															</script>";
														
								echo 			"</div>
												</div>
											</div>
										</div>";
								echo "<script>
												$('#modal_crop').modal({show:true})
											</script>";
								echo "<script type='text/javascript'>
												function getCanvas (usuario, nome) {
													var data = cropper.getData();
													var crop = data.x + ', ' + data.y + ', ' + data.width + ', ' + data.height;
													var xhttp = new XMLHttpRequest();
													xhttp.open('POST', 'sistema/sql/page_functions.php', true);
													xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
													xhttp.onreadystatechange = function () {
														if (xhttp.readyState === XMLHttpRequest.DONE){
															window.location.href = 'receita.php?id=" . $nome . "';
														}
													};
													xhttp.send('crop=' + crop + '&user=' + usuario + '&recipt=' + nome);
												}

											</script>";
								
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
					<input type="file" id="foto" class="form-control-file" name="foto" <?php if (isset($_GET['id'])){echo "disabled";} ?>></input>
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