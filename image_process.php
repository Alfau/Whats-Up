<?php
class image_process{
	public function upload($image_file){
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