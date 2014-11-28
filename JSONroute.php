<?php  
require_once("includes/JSONurlParse.php");
	
$url = new urlParse();

$controller = ucfirst($url -> getController());
$method = $url -> getMethod();
$params = $url -> getParams();

$controllerFile = "JSONcontrollers/".$controller."Controller.php";

if(is_readable($controllerFile)){
	require_once ($controllerFile);
	
	$controller = $controller."Controller";
	
	$controller = new $controller;
	$controller = $controller -> index();
}
?>