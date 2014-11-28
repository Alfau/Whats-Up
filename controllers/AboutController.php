<?php  
require_once("includes/connect.php");
require_once("models/About.php");
require_once("includes/view.php");

class PackagesController{
	
	function index(){
		
		$about=new About();
		$about=$about->getAbout("SELECT * FROM packages");
		
		$about = json_encode($about);
		
		$view = new View();
		$view = $view -> render("packages",$about);
			
	}
	
}

?>