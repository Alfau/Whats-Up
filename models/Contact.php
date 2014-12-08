<?php 
// require_once("includes/connect.php");

class Contact{
	protected $table = "contact";
	
	public function getContact($stmt){
		
		$con=new Connection();
		$con=$con->setCon();
		
		if($stmt === "All"){
			$query=$con->prepare("SELECT * FROM ".$this->table);
		}else{
			$query=$con->prepare($stmt);
		}
		
		$array=array();
		
		if($query->execute()){
			while($row=$query->fetch()){
				$array[]=$row;
			}
			return $array=array($array);
		}
	}
}

?>