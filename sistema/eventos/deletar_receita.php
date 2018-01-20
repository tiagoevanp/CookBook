<?php
	
	include "../sql/sql_connect.php";
	include "../sql/sql_session.php";
	include "../sql/page_functions";

	$id = $_GET['id'];
	
	deleteReceita($link, $id);
	
	header('Location: ../../painel.php')

?>