<?php
class Config{
	
	private $host = "182.168.0.116";
	private $db_name = "QA";
	private $username = "root";
	private $password = "";
	public $conn;
	
	$hostname = "182.168.0.116";
	$dbname = "QA";
	$username = "sa";
	$password = "w@tch9u@rd";
	
	public function getConnection(){
	
		$this->conn = null;
		
		try{
			//$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn = new PDO("sqlsrv:server=[sqlservername];Database=[sqlserverdbname]",  "[username]", "[password]");
		}catch(PDOException $exception){
			echo "Connection error: " . $exception->getMessage();
		}
		
		return $this->conn;
	}
}
?>
