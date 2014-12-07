<?php 
// require_once("includes/connect.php");

class Quotes{
	protected $table = "customer_quotes";
	
	public function getQuotes(){
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare("SELECT * FROM ".$this->table);//order by order asc
		
		$array=array();
		
		if($query->execute()){
			while($row=$query->fetch()){
				$array[]=$row;
			}
			return $array;
		}
	}
	
	public function deleteQuotes($id){
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare("DELETE FROM ".$this->table." WHERE ID='$id'");
		
		$array=array();
		
		if($query->execute()){
			$status = "<p class='success_strip'>Entry deleted successfully</p>";
		}else{
			$status = "<p class='failed_strip'>An error occured. Please try again.</p>";
		}
		
		return $array=array($this->getQuotes(), $status);
	}
}

?>