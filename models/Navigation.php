<?php 
// require_once("includes/connect.php");

class Navigation{
	public function getNavigation($position){
		$table = "navigation";
		
		$con=new Connection();
		$con=$con->setCon();
		
		if($position === "All"){
			$query=$con -> prepare("SELECT * FROM $table");//order by order asc
		}else{
			$query=$con -> prepare("SELECT * FROM $table WHERE Position=$position");//order by order asc
		}
		
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