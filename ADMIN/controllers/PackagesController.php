<?php 
require_once("../includes/connect.php");
require_once("../models/Packages.php");
require_once("../includes/view.php");

class PackagesController{
	
	public function index(){
		
		$packages = new Packages();
		$packages = $packages -> getPackages("All");
		
		$view = new View();
		$view = $view -> render("packages",array("data" => $packages));
		
	}
	
	function edit($id){
		
		$packages = new Packages();
		$packages = $packages -> getPackages("SELECT * FROM packages WHERE ID = $id");
		
		$view = new View();
		$view = $view -> render("packages_edit",array("data" => $packages));
	}
	
	function delete($id){
		$packages = new Packages();
		$packages = $packages -> deletePackages($id);
		
		$view = new View();
		$view = $view -> render("packages",array("data" => $packages[0], "delete_status" => $packages[1]));
	}
}

?>