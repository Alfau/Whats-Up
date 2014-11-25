<?php 
require_once("includes/connect.php");

class Navigation{
	public function getNav($position){
		$table = "nav";
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare("SELECT * FROM $table WHERE Position=$position");//order by order asc
		
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