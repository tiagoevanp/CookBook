	<?php
	include 'sql_functions.php';

	function user($link){
		$criteria = new criteria();
		$criteria->addCondition('login', $_SESSION['login']);
		return sqlFetchAssoc($link, $criteria, 'usuarios');
	}

	function selectReceitas($link) {
		$usuario = user($link);
		$criteria = new criteria();
		$criteria->addCondition('pessoaid', $usuario['id']);
		$criteria->order = ' nome_receita ';
		return sqlFetchAll($link, $criteria, 'receitas');
	}

	function loginCheck($link) {
		$login = $_POST['login_acesso'];
		$senha = $_POST['senha_acesso'];
		$salt = crypt($senha, 'criptografia');
		$senha_criptografica = crypt($senha, $salt);
		
		$criteria = new criteria();
		$criteria->addCondition('login', $login);
		$criteria->addCondition('senha', $senha_criptografica);
		
		$user = sqlQuerySelect($link, $criteria, 'usuarios');
		
		if (!empty($user->num_rows)) {
			$_SESSION['login'] = $login;
			$_SESSION['senha'] = $senha_criptografica;

			header('Location: painel.php');
		}
		else{
			echo "<div class='alert alert-danger'>Login ou senha incorretos!</div>";
		}
	}

	function nomeDuplicata ($link, $nome, $sobrenome) {
		$criteria = new criteria();
		$criteria->addCondition('nome', $nome);
		$criteria->addCondition('sobrenome', $sobrenome);

		return sqlQuerySelect($link, $criteria, 'usuarios');
	}

	function loginDuplicata ($link, $login, $senha) {
		$criteria = new criteria();
		$criteria->addcondition('login', $login);
		$criteria->addcondition('senha', $senha);

		return sqlQuerySelect($link, $criteria, 'usuarios');	
	}

	function duplicataCheck ($link) {
		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		$salt = crypt($senha, 'criptografia');
		
		$nomeDuplicata = nomeDuplicata($link, $nome, $sobrenome);
		$loginDuplicata = loginDuplicata($link, $login, $senha);
		
		if (mysqli_num_rows($nomeDuplicata) > 0){
			echo "<div class='alert alert-danger'>Nome e sobrenome já estão cadastrados!</div>";
		}

		else if (mysqli_num_rows($loginDuplicata) > 0) {
			echo "<div class='alert alert-danger'>Login e senha já existente!</div>";
		}

		elseif (strlen($login) < 6){
			echo "<div class='alert alert-danger'>Login deve ter no minimo 6 caracteres!</div>";
		}

		elseif (strlen($senha) < 6){
			echo "<div class='alert alert-danger'>Senha deve ter no mínimo 6 caracteres!</div>";
		}				

		else {
			$senha_criptografica = crypt($senha, $salt);
			$criteria = new criteria();
			$criteria->addConditionInsert(['nome', 'sobrenome', 'login', 'senha'], [$nome, $sobrenome, $login, $senha_criptografica]);
			$insert = sqlQueryInsert($link, $criteria, 'usuarios');
			
			createUserFolders($link, $login, $senha_criptografica);
		}
	}

	function createUserFolders ($link, $login, $senha) {
		$criteria = new criteria();
		$criteria->addCondition('login', $login);
		$criteria->addCondition('senha', $senha);

		$usuario = sqlFetchAssoc($link, $criteria, 'usuarios');

		mkdir('usuarios/' . $usuario['id'] . '/imagens', 0777, true);

		echo "<div class='alert alert-success'>Cadastro realizado com sucesso!</div>";
	}

	function deleteUser ($link) {
		$user = user($link);
		$criteria = new criteria();
		$criteria->addCondition('login', $user['login']);
		$criteria->addCondition('senha', $user['senha']);
		sqlQueryDelete($link, $criteria, 'usuarios');
		deleteReceitas($link, $user);
	}

	function deleteReceitas ($link, $user) {
		$criteria = new criteria();
		$criteria->addCondition('pessoaid', $user['pessoaid']);

		return sqlQueryDelete($link, $criteria, 'receitas');
	}

	function deleteReceita ($link, $id) {
		$criteria = new criteria();
		$criteria->addCondition('id', $id);

		return sqlQueryDelete ($link, $criteria, 'receitas');
	}

	function incluirReceita ($link) {
		$user = user($link);
		$receita = new receita();
		$receita->nome = $_POST['nome_receita'];
		$receita->autor = $_POST['autor'];
		$receita->ingredientes = $_POST['ingredientes'];
		$receita->preparo = $_POST['receita'];
		$criteria = new criteria();
		$criteria->addConditionInsert(['nome_receita', 'autor', 'ingredientes', 'receita', 'pessoaid'], [$receita->nome, $receita->autor, $receita->ingredientes, $receita->preparo, $user['id']]);
		return sqlQueryInsert($link, $criteria, 'receitas');
	}

	function selectReceita ($link) {
		$receita = new receita();
		$receita->nome = $_POST['nome_receita'];
		$receita->autor = $_POST['autor'];
		$receita->ingredientes = nl2br($_POST['ingredientes']);
		$receita->preparo = nl2br($_POST['receita']);
		$criteria = new criteria();
		$criteria->addCondition('nome_receita', $receita->nome);
		$criteria->addCondition('autor', $receita->autor);
		$criteria->addCondition('ingredientes', $receita->ingredientes);
		$criteria->addCondition('receita', $receita->preparo);
		
		return sqlFetchAssoc ($link, $criteria, 'receitas');								
	}

	function editarReceita ($link) {
		$criteria = new criteria();
		$criteria->addCondition('id', $_GET['id']);
		return sqlFetchAssoc($link, $criteria, 'receitas');
	}

	function salvarReceitaEditada ($link) {
		$receita = new receita();
		$criteria = new criteria();
		$receita->nome = $_POST['nome_receita'];
		$receita->autor = $_POST['autor'];
		$receita->ingredientes = nl2br($_POST['ingredientes']);
		$receita->preparo = nl2br($_POST['receita']);
		$criteria->addConditionUpdate('nome_receita', $receita->nome);
		$criteria->addConditionUpdate('autor', $receita->autor);
		$criteria->addConditionUpdate('ingredientes', $receita->ingredientes);
		$criteria->addConditionUpdate('receita', $receita->preparo);
		$criteria->addCondition('id', $_GET['id']);
		
		return sqlQueryUpdate($link, $criteria, 'receitas');
	}

	function procurarReceitas($link) {
		$usuario = user($link);
		$criteria = new criteria();
		$criteria->addCondition('pessoaid', $usuario['id']);
		$criteria->addConditionLike('nome_receita', $_POST['pesquisa']);
		$criteria->order = ' nome_receita ';
		return sqlFetchAll($link, $criteria, 'receitas');
	}
	
	if (!empty($_POST['crop'])) {

		actionCropFoto();
	}

	function actionCropFoto () {
		$crop = explode(',', $_POST['crop']);
		$usuario = $_POST['user'];
		$receita = $_POST['recipt'];
		// var_dump($crop);
		// echo $usuario . " " . $receita;
		
		$img = imagecreatefromjpeg('../../usuarios/' . $usuario . '/imagens/' . $receita . '.jpg');
		$imgX = $crop[0];
		$imgY = $crop[1];
		$width = $crop[2];
		$height = $crop[3];
		$cropImg = imagecrop($img, ['x' => $imgX, 'y' => $imgY, 'width' => $width, 'height' => $height]);
		$newImg = imagejpeg($cropImg, '../../usuarios/' . $usuario . '/imagens/' . $receita . 'croped.jpg');
	}
?>