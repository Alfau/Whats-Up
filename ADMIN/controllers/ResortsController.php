<?php 
require_once("../includes/connect.php");
require_once("../models/Resorts.php");
require_once("../includes/view.php");

class ResortsController{
	
	public function index(){
		
		$resorts = new Resorts();
		$resorts = $resorts -> getResorts("All");
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $resorts));
		
	}
	
	function edit($id){
		
		$resorts = new Resorts();
		$resorts = $resorts -> getResorts("SELECT * FROM resorts WHERE ID = $id");
		
		$view = new View();
		$view = $view -> render("_edit",array("data" => $resorts));
	}
	
	function update(){
		
		$resorts = new Resorts();
		$resorts = $resorts -> updateResorts($_POST);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $resorts[0], "update_status" => $resorts[1]));
	}
	
	function add(){
		
		$resorts = new Resorts();
		$resorts = $resorts -> addResorts($_POST);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $resorts[0], "add_status" => $resorts[1]));
	}
	
	function delete($id){
		$resorts = new Resorts();
		$resorts = $resorts -> deleteResorts($id);
		
		$view = new View();
		$view = $view -> render("_view",array("data" => $resorts[0], "delete_status" => $resorts[1]));
	}
}

?>