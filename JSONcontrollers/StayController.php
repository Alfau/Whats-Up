<?php 
require_once("includes/connect.php");
require_once("models/Stay.php");
require_once("models/Rooms.php");

class StayController{
	
	public function index(){
		
		$stay = new Stay();
		$stay = $stay -> getStay("SELECT * FROM stay");
		
		$rooms = new Rooms();
		$rooms = $rooms -> getRooms("SELECT * FROM rooms");
		
		$stayBundle = array("Stay" => $stay);
		
		echo json_encode($stay);
		
	}
	
}

?>