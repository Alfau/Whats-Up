<?php  
require_once("../includes/connect.php");
require_once("../includes/view.php");
require_once("models/Authentication.php");

class SessionsController{
	
	function login(){
		
		$view = new View();
		$view = $view -> render("_login",array(null));
	}
	
	function authentication(){
		
		$auth = new Authentication();
		$auth = $auth -> Authenticate($_POST);
		
		$view = new View();
		$view = $view -> render($auth[0], array("data" => $auth[1]));
	}
	
	function logout(){
		
		session_start();
		unset($_SESSION['Username']);
		session_destroy();
		
		$view = new View();
		$view = $view -> render("_login", array(null));
	}
}

?>