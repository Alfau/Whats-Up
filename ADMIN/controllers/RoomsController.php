<?php 
require_once("../includes/connect.php");
require_once("../models/Rooms.php");
require_once("../includes/view.php");

class RoomsController{
	
	public function index(){
		
		$rooms = new Rooms();
		$rooms = $rooms -> getRooms("All", "Resort");
		
		$view = new View();
		$view = $view -> render("rooms",array("data" => $rooms));
		
	}
	
	function edit($id){
		
		$rooms = new Rooms();
		$rooms = $rooms -> getRooms("SELECT * FROM rooms WHERE ID = $id", null);
		
		$view = new View();
		$view = $view -> render("_edit",array("data" => $rooms));
	}
		
	function update(){
		
		$rooms = new Rooms();
		$rooms = $rooms -> updateRooms($_POST);
		
		$view = new View();
		$view = $view -> render("rooms",array("data" => $rooms[0], "update_status" => $rooms[1]));
	}
	
	function add(){
		
		$rooms = new Rooms();
		$rooms = $rooms -> addRooms($_POST);
		
		$view = new View();
		$view = $view -> render("rooms",array("data" => $rooms[0], "add_status" => $rooms[1]));
	}
	
	function delete($id){
		$rooms = new Rooms();
		$rooms = $rooms -> deleteRooms($id);
		
		$view = new View();
		$view = $view -> render("resorts",array("data" => $rooms[0], "delete_status" => $rooms[1]));
	}
}

?>