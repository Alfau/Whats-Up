<?php  
require_once("../includes/connect.php");
require_once("../includes/view.php");

class SessionsController{
	
	function login(){
		
		$navigation = new Navigation();
		$navigation = $navigation -> getNavigation("All");
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $navigation));

	}
	
	function logout(){
		
	}
}

?>