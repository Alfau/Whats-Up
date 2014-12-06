<?php  
require_once("../includes/connect.php");
require_once("../models/About.php");
require_once("../includes/view.php");

class AboutController{
	
	function index(){
		
		$about = new About();
		$about = $about -> getAbout("SELECT * FROM about");
		
		$view = new View();
		$view = $view -> render("about",array("data" => $about));

	}
	
}

?>