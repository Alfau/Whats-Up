<?php 
require_once("../includes/connect.php");
require_once("../models/Packages.php");
require_once("../includes/view.php");

class PackagesController{
	
	public function index(){
		
		$packages = new Packages();
		$packages = $packages -> getPackages("SELECT * FROM packages");
		
		$view = new View();
		$view = $view -> render("packages",array("data" => $packages));
		
	}
	
}

?>