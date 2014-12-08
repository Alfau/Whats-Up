<?php  
require_once("includes/connect.php");
require_once("models/Slideshow.php");
require_once("models/Packages.php");
require_once("models/Quotes.php");

class HomeController{
	
	function index(){
		
		$slideshow = new Slideshow();
		$slideshow = $slideshow->getSlideshow("All");
		
		$packages = new Packages();
		$packages = $packages->getPackages("All", null);
		
		$quotes = new Quotes();
		$quotes = $quotes->getQuotes();
		
		$homeBundle = array("Slideshow"=>$slideshow, "Packages"=>$packages, "Quotes"=>$quotes);
		echo json_encode($homeBundle);
	}
	
}

?>