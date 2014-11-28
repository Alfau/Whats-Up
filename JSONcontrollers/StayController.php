<?php 
require_once("includes/connect.php");
require_once("models/Stay.php");

class StayController{
	
	public function index(){
		
		$stay = new Stay();
		$stay = $stay -> getStay("SELECT * FROM stay");
		
		echo json_encode($stay);
		
	}
	
}

?>