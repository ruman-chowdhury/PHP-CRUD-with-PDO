<?php
	
	class Database{
		private $servername ="localhost";
		private $db_user ="root";
		private $db_pass ="";
		private $db_name = "db_employee";

		public $conn;

		public function __construct(){

			if (!isset($this->conn)) {
				
				try{

					$pdo_obj =  new PDO("mysql:host=".$this->servername .";dbname=".$this->db_name, $this->db_user, $this->db_pass);

					$pdo_obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$pdo_obj->exec("SET character set utf8");
					$this->conn = $pdo_obj;

				}catch(PDOException $e){
					die("Connection Failed! ".$e->getMessage()); 

				}

			}

		} //end constructor

		/*
		$sql = $this->conn->prepare("SELECT * FROM tbl_userInfo WHERE Id=:Id AND Email=:Email LIMIT 5,2");

		$sql->bindValue(':Id', $Id);
		$sql->bindValue(':Email', $Email);
		$sql->execute();

		*/



	} //end Database class
	
?>