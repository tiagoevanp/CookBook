<?php
	// confirmando se sessão aberta
  	session_start();
  	if (!isset($_SESSION['login']) || !isset($_SESSION['senha'])) {
  		header('Location: index.html');
  	exit;
	}
?>