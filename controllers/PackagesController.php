<?php  
require_once("includes/connect.php");
require_once("models/Packages.php");
require_once("includes/view.php");

class PackagesController{
	
	function index(){
		
		$packages=new Packages();
		$packages=$packages->getPackages("SELECT * FROM packages");
		
		$packages = json_encode($packages);
		
		$view = new View();
		$view = $view -> render("packages",$packages);
			
	}
	
}

?>