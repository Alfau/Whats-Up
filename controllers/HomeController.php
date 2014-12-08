<?php  
require_once("includes/connect.php");
require_once("controllers/PackagesController.php");
require_once("models/Slideshow.php");
require_once("models/Packages.php");
require_once("models/Quotes.php");
require_once("includes/view.php");

class HomeController extends PackagesController{
	
	function index(){
		
		$slideshow = new Slideshow();
		$slideshow = $slideshow->getSlideshow("All");
		
		$packages = new Packages();
		$packages = $packages->getPackages("All", null);
		
		$quotes = new Quotes();
		$quotes = $quotes->getQuotes();
		
		$view = new View();
		$view = $view -> render("home",array("Slideshow"=>$slideshow, "Packages"=>$packages, "Quotes"=>$quotes));
		
	}
	
}

?>