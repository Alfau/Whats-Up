<?php 
// require_once("includes/connect.php");

class Navigation{
	protected $table = "navigation";
	
	public function getNavigation($position){
		
		$con=new Connection();
		$con=$con->setCon();
		
		if($position === "All"){
			$query=$con -> prepare("SELECT * FROM ".$this->table);//order by order asc
		}else{
			$query=$con -> prepare("SELECT * FROM ".$this->table." WHERE Position=$position");//order by order asc
		}
		
		$array=array();
		
		if($query->execute()){
			while($row=$query->fetch()){
				$array[]=$row;
			}
			return $array;
		}
	}
	public function updateNavigation($post_data){
		
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
		
	public function deleteNavigation($id){
		
		$con=new Connection();
		$con=$con->setCon();
		$query=$con -> prepare("DELETE FROM ".$this->table." WHERE ID='$id'");
		
		$array=array();
		
		if($query->execute()){
			$status = "<p class='success_strip'>Entry deleted successfully</p>";
		}else{
			$status = "<p class='failed_strip'>An error occured. Please try again.</p>";
		}
		
		return $array=array($this->getNavigation("All"), $status);
	}
}

?>