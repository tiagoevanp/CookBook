<?php
	
	// confirmando se COOKIE está setado
  	
    session_start();
  	
    if (!isset($_SESSION['login']) || !isset($_SESSION['senha'])) {
  		header('Location: index.php');
  		
    exit;
  	
    }
?>