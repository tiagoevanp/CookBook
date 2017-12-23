<?php

	include "sql_connect.php";
	include "sql_session.php";

	$sessionLogin = $_SESSION['login'];
	$pessoaId = mysqli_query($link, "SELECT pessoaid FROM usuarios WHERE login = '$sessionLogin'");
	$fetch = mysqli_fetch_row($pessoaId);
		
	$delreceitas = mysqli_query($link, "DELETE FROM receitas WHERE pessoaid = '$fetch[0]'");
	$delusuario = mysqli_query($link,"DELETE FROM usuarios WHERE login = '$_SESSION[login]'");

	
	session_start();
	session_destroy();
	
	header('Location: ../index.php');

?>