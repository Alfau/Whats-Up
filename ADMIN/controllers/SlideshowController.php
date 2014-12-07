<?php  
require_once("../includes/connect.php");
require_once("../models/Slideshow.php");
require_once("../includes/view.php");

class SlideshowController{
	
	function index(){
		
		$slideshow = new Slideshow();
		$slideshow = $slideshow->getSlideshow("SELECT * FROM slideshow");
		
		$view = new View();
		$view = $view -> render("slideshow",array("data" => $slideshow));

	}
	
	function edit($id){
		
		$slideshow = new Slideshow();
		$slideshow = $slideshow -> getSlideshow("SELECT * FROM slideshow WHERE ID = $id");
		
		$view = new View();
		$view = $view -> render("slideshow_edit",array("data" => $slideshow));
	}
}

?>