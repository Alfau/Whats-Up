<?php 
// require_once("includes/connect.php");

class Navigation{
	protected $table = "navigation";
	
	public function getNavigation($stmt){
		
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
	
	public function updateNavigation($post_data, $image_file){
		
		$image = $this -> processImage($image_file['Image']['tmp_name']);
		
		if($image !== "failed"){
			$stmt = "UPDATE ".$this->table." SET";
			foreach($post_data as $key => $value){
				if($key !== "ID"){
					$stmt .= " $key = '$value',";	
				}
			}
			if($image !== "empty"){
				$stmt .= " Image = 'assets/icons/$image'";
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
			
			return $array=array($this->getNavigation("All"), $status);
			
		}else{
			$status = "Image upload failed. Please check whether the image you uploaded was a JPG or a PNG.";
			return $array=array($this->getNavigation("All"), $status);
		}
	}
	
	public function addNavigation($post_data, $image_file){
		
		$image = $this -> processImage($image_file['Image']['tmp_name']);
		
		if($image !== "failed"){
			$stmt = "INSERT INTO ".$this->table." (";
			foreach($post_data as $key => $value){
				$stmt .= "$key,";
			}
			if($image !== "empty"){
				$stmt .= "Image";
			}
			$stmt = rtrim($stmt, ",");
			$stmt .= ") VALUES(";
			foreach($post_data as $key => $value){
				$value = addslashes($value);
				$stmt .= "'$value',";
			}
			if($image !== "empty"){
				$stmt .= "'assets/icons/$image'";
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
			
			return $array=array($this->getNavigation("All"), $status);
		}else{
			$status = "Image upload failed. Please check whether the image you uploaded was a JPG or a PNG.";
			return $array=array($this->getNavigation("All"), $status);
		}
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
				if(move_uploaded_file($image_file, "../assets/icons/".$filename)){
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