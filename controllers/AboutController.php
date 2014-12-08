<?php  
require_once("includes/connect.php");
require_once("models/About.php");
require_once("includes/view.php");

class AboutController{
	
	function index(){
		
		$about=new About();
		$about=$about->getAbout("SELECT * FROM about");
		
		$aboutBundle = array("About" => $about);
		
		$aboutBundle = json_encode($aboutBundle);
		
		$view = new View();
		$view = $view -> render("_views",array("About" => $about));
	}
}
?>