<?php
	class connectDatabase {
		private $host = "localhost";
		private $user = "phpmyadmin";
		private $pass = "39907200";
		private $banco = "meu_livro_de_receitas";

		public function connectWithDatabase() {
			$link = mysqli_connect($this->host, $this->user, $this->pass, $this->banco);
			$this->setCharsetOfDatabase($link);
			$this->checkConnectionWithDatabase($link);
			return $link;
		}
		
		private function setCharsetOfDatabase($link) {
			$link->set_charset("utf8");
		}
		

		private function checkConnectionWithDatabase($link) {
			if (!$link){
		  		die("Erro de conexão: " . mysqli_connect_error());
			};
		}
	}
		
