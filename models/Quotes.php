<?php 
require_once("includes/connect.php");

class Quotes{
	public function getQuotes($position){
		$table = "customer_quotes";
		
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