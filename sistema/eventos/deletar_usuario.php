<?php

	include "../sql/sql_connect.php";
	include "../sql/sql_session.php";
	include "../sql/page_functions";

	deleteUser ($link);
	
	session_start();
	session_destroy();
	
	header('Location: ../../index.php');

?>