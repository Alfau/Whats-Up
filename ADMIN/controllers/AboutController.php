<?php  
require_once("../includes/connect.php");
require_once("../models/About.php");
require_once("../includes/view.php");

class AboutController{
	
	function index(){
		
		$about = new About();
		$about = $about -> getAbout("All");
		
		$view = new View();
		$view = $view -> render("about",array("data" => $about));

	}
	
	function edit($id){
		
		$about = new About();
		$about = $about -> getAbout("SELECT * FROM about WHERE ID = $id");
		
		$view = new View();
		$view = $view -> render("about_edit",array("data" => $about));
	}
	
	function delete($id){
		
		$about = new About();
		$about = $about -> deleteAbout($id);
		
		$view = new View();
		$view = $view -> render("about",array("data" => $about[0], "delete_status" => $about[1]));
	}
	
}

?>