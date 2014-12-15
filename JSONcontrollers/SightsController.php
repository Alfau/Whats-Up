<?php  
require_once("includes/connect.php");
require_once("models/Sights.php");
require_once("includes/view.php");

class SightsController{
	
	function index(){
		
		$sights=new Sights();
		$sights=$sights->getSights("All");
		
		$sightsBundle = array("Sights" => $sights);
		
		echo json_encode($sightsBundle);
	}
	
	public function details(){
		
		$sights=new Sights();
		$sights=$sights->getSights("All");
		
		$sightsBundle = array("Sights" => $sights);
		
		echo json_encode($sightsBundle);
	}
}

?>