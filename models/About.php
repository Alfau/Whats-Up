<?php 
// require_once("includes/connect.php");

class About{
	public function getAbout($stmt){
		$table = "about";
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare($stmt);//order by order asc
		
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