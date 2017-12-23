<?php
	
	include "sql_connect.php";
	include "sql_session.php";

	$id = $_GET['id'];
	$delreceita = mysqli_query($link,"DELETE FROM receitas WHERE id ='$id'");
	
	header('Location: ../painel.php')

?>