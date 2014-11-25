<?php  
require_once("urlParse.php");

class Route{
	
	public function __construct(){
		$url = new urlParse();
		
		$controller = $url -> getController();
		$method = $url -> getMethod();
		$params = $url -> getParams();
		
		$controllerFile = "controllers/".$controller."Controller.php";
		
		if(is_readable($controllerFile)){
			require_once ($controllerFile);
			
			$controller = $controller."Controller";
			
			$controller = new $controller;
			$controller = $controller -> index();
			
		}
	}
	
	
}

?>