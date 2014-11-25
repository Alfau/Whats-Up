<?php  

class Connection{
	
	protected $host="localhost";
	protected $dbname="whatsup";
	protected $username="root";
	protected $password="";
	
	protected $con;
	
	function __construct(){
		try{
			$this->con=new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
			$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "error : ".$e->getMessage();
		}
	}
	
	function setCon(){
		if($this->con instanceof PDO){
			return $this->con;
		}
	}
}

?>