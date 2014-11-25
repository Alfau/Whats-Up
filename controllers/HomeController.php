<?php  
require_once("includes/connect.php");
require_once("controllers/PackagesController.php");
require_once("models/Slideshow.php");
require_once("models/Packages.php");
// require_once("models/Quotes.php");

class HomeController extends PackagesController{
	
	function slideshow(){
		
		$slideshow=new Slideshow();
		$slideshow=$slideshow->getSlideshow("SELECT * FROM slideshow");
		
		return $slideshow;
	}
	
}

?>