<?php 
require_once("../includes/connect.php");

class Authentication{
	protected $table = "admin_cred";
	
	public function Authenticate($cred){
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare("SELECT Username, Password FROM ".$this -> table);
		
		$array=array();
		
		if($query->execute()){
			while($row=$query->fetch()){
				$array[]=$row;
			}
		}
		if($cred['Username'] === $array[0]['Username'] && $cred['Password'] === $array[0]['Password']){
			session_start();
			$_SESSION['Username'] = $array[0]['Username'];
			
			return $array = array("_login", array("status" => "Login Successfull"));
		}else{
			return $array = array("_login", array("status" => "Login Failed"));
		}
	}
}

?>