<?php 
require_once("includes/connect.php");
require_once("models/Resorts.php");
require_once("models/Rooms.php");

class StayController{
	
	public function index(){
		
		$stay = new Resorts();
		$stay = $stay -> getResorts("SELECT * FROM resorts");
		
		// $rooms = new Rooms();
		// $rooms = $rooms -> getRooms("SELECT * FROM rooms");
		
		$stayBundle = array("Resorts" => $stay);
		
		echo json_encode($stayBundle);
		
	}
	
	public function details(){
		
		$rooms = new Rooms();
		$rooms = $rooms -> getRooms("SELECT * FROM rooms");
		
		$stayBundle = array("Rooms" => $rooms);
		
		echo json_encode($stayBundle);
	} 
}

?>