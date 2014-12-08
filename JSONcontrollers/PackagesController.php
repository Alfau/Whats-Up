<?php 
require_once("includes/connect.php");
require_once("models/Packages.php");

class PackagesController{
	
	public function index(){
		
		$packages = new Packages();
		$packages = $packages -> getPackages("All", null);
		
		$packagesBundle = array("Packages" => $packages);
		
		echo json_encode($packagesBundle);
		
	}
	
	public function details(){
		
		$packages = new Packages();
		$packages = $packages -> getPackages("All", null);
		
		$packagesBundle = array("Packages" => $packages);
		
		echo json_encode($packagesBundle);
	} 
}

?>