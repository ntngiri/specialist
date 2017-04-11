<?php

	/**
	* 
	*/
	class db
	{

		private $dbhost = '127.0.0.1';
		private $dbuser = 'specialistUser';
		private $pass = 'Ntnbhaw1!';
		private $dbname = 'specialistDB';
		
		public function connect(){
			$pdoString = "mysql:host=$this->dbhost;dbname=$this->dbname;port=3306";
			$pdo  = new PDO($pdoString,$this->dbuser,$this->pass);
			// $pdo = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname",
   //      	$this->dbuser, $this->pass);
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		    return $pdo;
		}
	}
