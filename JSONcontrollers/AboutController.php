<?php 
require_once("includes/connect.php");
require_once("models/About.php");

class AboutController{
	
	public function index(){
		
		$about = new About();
		$about = $about -> getAbout("All");
		
		$aboutBundle = array("About" => $about);
		
		echo json_encode($aboutBundle);
		
	}
	
}

?>