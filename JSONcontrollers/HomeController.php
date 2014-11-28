<?php  
require_once("includes/connect.php");
require_once("models/Slideshow.php");
require_once("models/Packages.php");
require_once("models/Quotes.php");

class HomeController{
	
	function index(){
		
		$slideshow = new Slideshow();
		$slideshow = $slideshow->getSlideshow("SELECT * FROM slideshow");
		
		$packages = new Packages();
		$packages = $packages->getPackages("SELECT * FROM packages");
		
		$quotes = new Quotes();
		$quotes = $quotes->getQuotes("SELECT * FROM customer_quotes");
		
		$homeBundle = array("slideshow"=>$slideshow, "packages"=>$packages, "quotes"=>$quotes);
		echo json_encode($homeBundle);
	}
	
}

?>