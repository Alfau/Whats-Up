<?php 
require_once("../includes/connect.php");
require_once("../models/Packages.php");
require_once("../includes/view.php");

class PackagesController{
	
	function index(){
		
		$packages = new Packages();
		$packages = $packages -> getPackages("All","Resorts");
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $packages));	
	}
	
	function edit($id){
		
		$packages = new Packages();
		$packages = $packages -> getPackages("SELECT * FROM packages WHERE ID = $id", null);
		
		$view = new View();
		$view = $view -> render("_edit",array("data" => $packages));
	}
	
	function update(){
		
		$packages = new Packages();
		$packages = $packages -> updatePackages($_POST);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $packages[0], "update_status" => $packages[1]));
	}
	
	function add(){
		
		$packages = new Packages();
		$packages = $packages -> addPackages($_POST);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $packages[0], "add_status" => $packages[1]));
	}
	
	function delete($id){
		
		$packages = new Packages();
		$packages = $packages -> deletePackages($id);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $packages[0], "delete_status" => $packages[1]));
	}
}

?>