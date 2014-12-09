<?php

require_once "../includes/paths.php";

class Route{
	public function __construct(){
		// $url = $_SERVER['REQUEST_URI'];
		// $url_segments = explode("/", $url);
		
		$url = explode(URL::base(), URL::current());
		
		$url_segments = explode("/", $url[1]);
		
		$controller = (isset($url_segments[1]) && !empty($url_segments[1])) ? $url_segments[1] : "about";
		$method = (isset($url_segments[2]) && !empty($url_segments[2])) ? $url_segments[2] : "index";
		$param = (isset($url_segments[3]) && !empty($url_segments[3])) ? $url_segments[3] : "";
		
		if($controller === "login"){
			$controller = "sessions";
			$method = "login";
		}
		if($controller === "logout"){
			$controller = "sessions";
			$method = "logout";
		}
		
		$controller_file = "controllers/".$controller."Controller.php";
		
		if(is_readable($controller_file)){
			require_once ($controller_file);
			
			$controller = $controller."Controller";
			
			$controller = new $controller;
			$controller = $controller -> $method($param);
			
		}
	}
	
	
}

?>