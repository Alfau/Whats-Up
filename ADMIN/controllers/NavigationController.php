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
	
}

?>