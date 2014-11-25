<?php  
require_once("includes/connect.php");
require_once("models/Packages.php");

class PackagesController{
	
	function packages(){
		
		$packages=new Packages();
		$packages=$packages->getPackages("SELECT * FROM packages");
		
		return  $packages;
			
	}
	
}

?>