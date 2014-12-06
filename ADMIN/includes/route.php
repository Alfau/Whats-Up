<?php

class Route{
	public function __construct(){
		$url = $_SERVER['REQUEST_URI'];
		$url_segments = explode("/", $url);
		
		
		$controller = (isset($url_segments[3]) && !empty($url_segments[3])) ? $url_segments[3] : "about";
		$method = (isset($url_segments[4])) ? $url_segments[4] : "index";
		// $params = (isset($url_segments[0])) ? $url_segments : array();
		
		$controller_file = "controllers/".$controller."Controller.php";
		
		if(is_readable($controller_file)){
			require_once ($controller_file);
			
			$controller = $controller."Controller";
			
			$controller = new $controller;
			$controller = $controller -> $method();
			
		}
	}
	
	
}

?>