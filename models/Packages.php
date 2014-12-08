<?php  
// require_once "includes/connect.php";
include_once("Resorts.php");

class Packages{
	protected $table = "packages";
	
	public function getPackages($stmt, $rst){ //stmt = statement, rst = resort
		
		$con=new Connection();
		$con=$con->setCon();
		
		if($stmt === "All"){
			$query=$con->prepare("SELECT * FROM ".$this->table);
		}else{
			$query=$con->prepare($stmt);
		}
		
		$array=array();
		
		if(empty($rst)){
			if($query->execute()){
				while($row=$query->fetch()){
					$array[]=$row;
				}
				return $array=array($array);
			}
		}else{
			if($query->execute()){
				while($row=$query->fetch()){
					$array[]=$row;
				}
				$resorts = new Resorts();
				return $array=array($array, $resorts->getResorts("SELECT Name FROM resorts"));
			}
		}
	}
	
	public function updatePackages($post_data){
		
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
		
		return $array=array($this->getPackages("All"), $status);
	}
	
	public function addPackages($post_data){
		
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
		
		return $array=array($this->getPackages("All"), $status);
	}
		
	public function deletePackages($id){
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare("DELETE FROM ".$this->table." WHERE ID='$id'");
		
		$array=array();
		
		if($query->execute()){
			$status = "<p class='success_strip'>Entry deleted successfully</p>";
		}else{
			$status = "<p class='failed_strip'>An error occured. Please try again.</p>";
		}
		
		return $array=array($this->getPackages("All"), $status);
	}
}

?>