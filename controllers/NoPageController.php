<?php
require_once("includes/view.php");

class ErrorPage{
	
	function index($error){
		
		switch($error){
			case "404" :
				$view = new View();
				$view = $view -> render("_404",array(null));
				break;
		}
			
	}
	
}

?>