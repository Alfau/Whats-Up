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
	
	function delete($id){
		$slideshow = new Slideshow();
		$slideshow = $slideshow -> deleteSlideshow($id);
		
		$view = new View();
		$view = $view -> render("resorts",array("data" => $slideshow[0], "delete_status" => $slideshow[1]));
	}
}

?>