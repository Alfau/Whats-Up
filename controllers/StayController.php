<?php 
require_once("includes/connect.php");
require_once("includes/view.php");
require_once("models/Resorts.php");
require_once("models/Rooms.php");

class StayController{
	
	public function index(){
		
		$stay = new Resorts();
		$stay = $stay -> getResorts("All");
		
		$stayBundle = array("Resorts" => $stay);
		
		$stayBundle = json_encode($stayBundle);
		
		$view = new View();
		$view = $view -> render("_views",array("Resorts" => $stayBundle));
	}
	
	public function details(){
		
		$rooms = new Rooms();
		$rooms = $rooms -> getRooms("All", null);
		
		$roomsBundle = array("Rooms" => $rooms);
		
		$roomsBundle = json_encode($roomsBundle);
		
		$view = new View();
		$view = $view -> render("_views",array("Rooms" => $roomsBundle));
	} 
}

?>