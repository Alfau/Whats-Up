<?php 
require_once("../includes/connect.php");

class AdminNavigation{
	public function getNavigation(){
		$table = "admin_navigation";
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare("SELECT * FROM $table");//order by order asc
		
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