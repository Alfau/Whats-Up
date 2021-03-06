<?php  
require_once("../includes/connect.php");
require_once("../models/Slideshow.php");
require_once("../includes/view.php");

class SlideshowController{
	
	function index(){
		
		$slideshow = new Slideshow();
		$slideshow = $slideshow->getSlideshow("SELECT * FROM slideshow");
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $slideshow));

	}
	
	function edit($id){
		
		$slideshow = new Slideshow();
		$slideshow = $slideshow -> getSlideshow("SELECT * FROM slideshow WHERE ID = $id");
		
		$view = new View();
		$view = $view -> render("_edit",array("data" => $slideshow));
	}
		
	function update(){
		
		$slideshow = new Slideshow();
		$slideshow = $slideshow -> updateSlideshow($_POST, $_FILES);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $slideshow[0], "update_status" => $slideshow[1]));
	}
	
	function add(){
		
		$slideshow = new Slideshow();
		$slideshow = $slideshow -> addSlideshow($_POST, $_FILES);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $slideshow[0], "add_status" => $slideshow[1]));
	}
	
	function delete($id){
		$slideshow = new Slideshow();
		$slideshow = $slideshow -> deleteSlideshow($id);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $slideshow[0], "delete_status" => $slideshow[1]));
	}
}

?>