<!DOCTYPE html>

<?php
	include "sql_connect.php";
	include "sql_session.php";
?>

<html>

<head>
	<meta charset="utf-8">	
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Deletanto Usuário</title>

</head>

<body>
	<?php
		echo "$_SESSION[login]";
		$delusuario = mysqli_query($link,"DELETE FROM usuarios WHERE login = '$_SESSION[login]'");
		session_start();
		session_destroy();
		header('Location: index.php');
	?>
</body>

</html>