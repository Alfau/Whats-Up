<?php  
require_once "includes/connect.php";

class Packages{
	protected $table = "packages";
	
	function getPackages($stmt){
		
		$con=new Connection();
		$con=$con->setCon();
		
		$query=$con->prepare($stmt);
		
		$array=array();
		
		if($query->execute()){
			while($row=$query->fetch()){
				$array[]=$row;
			}
			return $array;
		}
	}
}

?>