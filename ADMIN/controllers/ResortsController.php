<?php 
require_once("../includes/connect.php");
require_once("../models/Resorts.php");
require_once("../includes/view.php");

class ResortsController{
	
	public function index(){
		
		$resorts = new Resorts();
		$resorts = $resorts -> getResorts("SELECT * FROM resorts");
		
		$view = new View();
		$view = $view -> render("resorts",array("data" => $resorts));
		
	}
	
}

?>