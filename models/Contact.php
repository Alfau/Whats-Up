<?php 
// require_once("includes/connect.php");

class Contact{
	public function getContact($stmt){
		$table = "contact";
		
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