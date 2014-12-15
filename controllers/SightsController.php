<?php  
require_once("includes/connect.php");
require_once("models/Sights.php");
require_once("includes/view.php");

class SightsController{
	
	function index(){
		
		$sights=new Sights();
		$sights=$sights->getSights("All");
		
		$sightsBundle = array("Sights" => $sights);
		$sightsBundle = json_encode($sightsBundle);
		
		$view = new View();
		$view = $view -> render("_views",array("Sights" => $sightsBundle));
			
	}
	
	public function details(){
		
		$sights=new Sights();
		$sights=$sights->getSights("All");
		
		$sightsBundle = array("Sights" => $sights);
		$sightsBundle = json_encode($sightsBundle);
		
		$view = new View();
		$view = $view -> render("_views",array("Sights" => $sightsBundle));
	}
}

?>