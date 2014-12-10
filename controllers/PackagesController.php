<?php  
require_once("includes/connect.php");
require_once("models/Packages.php");
require_once("includes/view.php");

class PackagesController{
	
	function index(){
		
		$packages=new Packages();
		$packages=$packages->getPackages("All", null);
		
		$packagesBundle = array("Packages" => $packages);
		$packagesBundle = json_encode($packagesBundle);
		
		$view = new View();
		$view = $view -> render("_views",array("Packages" => $packagesBundle));
			
	}
	
	public function details(){
		
		$packages=new Packages();
		$packages=$packages->getPackages("All", null);
		
		$packagesBundle = array("Packages" => $packages);
		$packagesBundle = json_encode($packagesBundle);
		
		$view = new View();
		$view = $view -> render("_views",array("Packages" => $packagesBundle));
	}
}

?>