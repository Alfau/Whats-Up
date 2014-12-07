<?php  
require_once("../includes/connect.php");
require_once("../models/Navigation.php");
require_once("../includes/view.php");

class NavigationController{
	
	function index(){
		
		$navigation = new Navigation();
		$navigation = $navigation -> getNavigation("All");
		
		$view = new View();
		$view = $view -> render("navigation",array("data" => $navigation));

	}
	
	function edit($id){
		
		$navigation = new Navigation();
		$navigation = $navigation -> getNavigation("SELECT * FROM navigation WHERE ID = $id");
		
		$view = new View();
		$view = $view -> render("navigation_edit",array("data" => $navigation));
	}
	
	function delete($id){
		
		$navigation = new Navigation();
		$navigation = $navigation -> deleteNavigation($id);
		
		$view = new View();
		$view = $view -> render("navigation",array("data" => $navigation[0], "delete_status" => $navigation[1]));
	}
}

?>