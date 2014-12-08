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
		$view = $view -> render("_edit",array("data" => $about));
	}
	
	function update(){
		
		$about = new About();
		$about = $about -> updateAbout($_POST);
		
		$view = new View();
		$view = $view -> render("about",array("data" => $about[0], "update_status" => $about[1]));
	}
	
	function add(){
		
		$about = new About();
		$about = $about -> addAbout($_POST);
		
		$view = new View();
		$view = $view -> render("about",array("data" => $about[0], "add_status" => $about[1]));
	}
	
	function delete($id){
		
		$about = new About();
		$about = $about -> deleteAbout($id);
		
		$view = new View();
		$view = $view -> render("about",array("data" => $about[0], "delete_status" => $about[1]));
	}
	
}

?>