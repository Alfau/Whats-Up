<?php  
// require_once "includes/connect.php";
include_once("Resorts.php");

class Packages{
	protected $table = "packages";
	
	public function getPackages($stmt, $rst){
		
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
	
	public function updatePackages($post_data, $image_file){
		
		$image = $this -> processImage($image_file['Image']['tmp_name']);
		
		if($image !== "failed"){
			$stmt = "UPDATE ".$this->table." SET";
			foreach($post_data as $key => $value){
				if($key !== "ID"){
					$stmt .= " $key = '$value',";	
				}
			}
			if($image !== "empty"){
				$stmt .= " Image = 'assets/uploads/$image'";
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
			
			return $array=array($this->getPackages("All", null), $status);
			
		}else{
			$status = "Image upload failed. Please check whether the image you uploaded was a JPG or a PNG.";
			return $array=array($this->getPackages("All", null), $status);
		}
	}
	
	public function addPackages($post_data, $image_file){
		
		$resort_name = $post_data['Resort'];
		
		$resort = new Resorts();
		$ResortID = $resort->getResorts("SELECT ID FROM resorts WHERE Name = '$resort_name'");
		$ResortID = $ResortID[0][0][0];
		
		$image = $this -> processImage($image_file['Image']['tmp_name']);
		
		if($image !== "failed"){
			$stmt = "INSERT INTO ".$this->table." (ResortID,";
			foreach($post_data as $key => $value){
				$stmt .= "$key,";
			}
			if($image !== "empty"){
				$stmt .= "Image";
			}
			$stmt = rtrim($stmt, ",");
			$stmt .= ") VALUES('$ResortID',";
			foreach($post_data as $key => $value){
				$value = addslashes($value);
				$stmt .= "'$value',";
			}
			if($image !== "empty"){
				$stmt .= "'assets/uploads/$image'";
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
			
			return $array=array($this->getPackages("All", null), $status);
		}else{
			$status = "Image upload failed. Please check whether the image you uploaded was a JPG or a PNG.";
			return $array=array($this->getPackages("All", null), $status);
		}
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
		
		return $array=array($this->getPackages("All", null), $status);
	}
	
	public function processImage($image_file){
		$status = true;
		
		if(!empty($image_file)){
			$image_type = exif_imagetype($image_file);
		    $allowedTypes = array(
		        2,  // jpg
		        3  // png
		    );
			
		    if (!in_array($image_type, $allowedTypes)) {
		        $status = false;
		    }
		    
		    switch($image_type){
				case 2 : $ext = ".jpg"; break;
				case 3 : $ext = ".png"; break; 
		    }
		    $filename = mt_rand().mt_rand().$ext;
		    
			if($status === true){
				if(move_uploaded_file($image_file, "../assets/uploads/".$filename)){
					return $filename;
				}else{
					return "failed";
				}
			}
		}else{
			return "empty";
		}
	}
}

?>