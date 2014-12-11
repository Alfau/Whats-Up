<?php  
require_once("../includes/connect.php");
require_once("../models/Navigation.php");
require_once("../includes/view.php");

class NavigationController{
	
	function index(){
		
		$navigation = new Navigation();
		$navigation = $navigation -> getNavigation("All");
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $navigation));

	}
	
	function edit($id){
		
		$navigation = new Navigation();
		$navigation = $navigation -> getNavigation("SELECT * FROM navigation WHERE ID = '$id'");
		
		$view = new View();
		$view = $view -> render("_edit",array("data" => $navigation));
	}
	
	function update(){
		
		$navigation = new Navigation();
		$navigation = $navigation -> updateNavigation($_POST, $_FILES);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $navigation[0], "update_status" => $navigation[1]));
	}
	
	function add(){
		
		$navigation = new Navigation();
		$navigation = $navigation -> addNavigation($_POST, $_FILES);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $navigation[0], "add_status" => $navigation[1]));
	}
	
	function delete($id){
		
		$navigation = new Navigation();
		$navigation = $navigation -> deleteNavigation($id);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $navigation[0], "delete_status" => $navigation[1]));
	}
}

?>