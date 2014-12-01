<?php 
require_once("includes/connect.php");
require_once("models/Packages.php");

class PackagesController{
	
	public function index(){
		
		$packages = new Packages();
		$packages = $packages -> getPackages("SELECT * FROM packages");
		
		$packagesBundle = array("Packages" => $packages);
		
		echo json_encode($packagesBundle);
		
	}
	
}

?>