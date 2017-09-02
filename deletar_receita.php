<!DOCTYPE html>

<?php
	include "sql_connect.php";
	include "sql_session.php";
?>

<html>

<head>
	<meta charset="utf-8">	
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Deletanto Receita</title>

</head>

<body>
	<?php
		$id = $_GET['id'];
		$delreceita = mysqli_query($link,"DELETE FROM receitas WHERE id ='$id'");
		header('Location: painel.php')
	?>
</body>

</html>