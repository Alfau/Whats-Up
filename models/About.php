<?php 
// require_once("includes/connect.php");

class About{
	protected $table = "about";
	
	public function getAbout($stmt){
		
		$con=new Connection();
		$con=$con->setCon();
		
		if($stmt === "All"){
			$query=$con -> prepare("SELECT * FROM ".$this->table);//order by order asc
		}else{
			$query=$con -> prepare($stmt);//order by order asc
		}
		
		$array=array();
		
		if($query->execute()){
			while($row=$query->fetch()){
				$array[]=$row;
			}
			return $array=array($array);
		}
	}
	
	public function updateAbout($post_data){
		
		$stmt = "UPDATE ".$this->table." SET";
		foreach($post_data as $key => $value){
			if($key !== "ID"){
				$stmt .= " $key = '$value',";
			}
		}
		$stmt = rtrim($stmt, ",");
		$stmt .= " WHERE ID = '".$post_data['ID']."'";
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare($stmt);
		
		if($query->execute()){
			$status = "<p class='success_strip'>Entry updated successfully</p>";
		}else{
			$status = "<p class='failed_strip'>An error occured. Please try again.</p>";
		}
		
		return $array=array($this->getAbout("All"), $status);
	}
	
	public function addAbout($post_data){
		
		$stmt = "INSERT INTO ".$this->table." (";
		foreach($post_data as $key => $value){
			$stmt .= "$key,";
		}
		$stmt = rtrim($stmt, ",");
		$stmt .= ") VALUES(";
		foreach($post_data as $key => $value){
			$value = addslashes($value);
			$stmt .= "'$value',";
		}
		$stmt = rtrim($stmt, ",").")";
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare($stmt);
		
		if($query->execute()){
			$status = "<p class='success_strip'>Entry added successfully</p>";
		}else{
			$status = "<p class='failed_strip'>An error occured. Please try again.</p>";
		}
		
		return $array=array($this->getAbout("All"), $status);
	}
	
	public function deleteAbout($id){
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare("DELETE FROM ".$this->table." WHERE ID='$id'");
		
		$array=array();
		
		if($query->execute()){
			$status = "<p class='success_strip'>Entry deleted successfully</p>";
		}else{
			$status = "<p class='failed_strip'>An error occured. Please try again.</p>";
		}
		
		return $array=array($this->getAbout("All"), $status);
	}
}

?>