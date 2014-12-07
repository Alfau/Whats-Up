<?php 
require_once("../includes/connect.php");
require_once("../models/Rooms.php");
require_once("../includes/view.php");

class RoomsController{
	
	public function index(){
		
		$rooms = new Rooms();
		$rooms = $rooms -> getRooms("SELECT * FROM rooms");
		
		$view = new View();
		$view = $view -> render("rooms",array("data" => $rooms));
		
	}
	
	function edit($id){
		
		$rooms = new Rooms();
		$rooms = $rooms -> getRooms("SELECT * FROM rooms WHERE ID = $id");
		
		$view = new View();
		$view = $view -> render("rooms_edit",array("data" => $rooms));
	}
}

?>