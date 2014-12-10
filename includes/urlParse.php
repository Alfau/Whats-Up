<?php
require_once "includes/paths.php";

class urlParse{
	protected $controller;
	protected $method;
	protected $params;
	
	function __construct(){
		$url = explode(URL::base(), URL::current());
		$url_segments = explode("/", $url[1]);
		
		$this -> controller = (isset($url_segments[0]) && !empty($url_segments[0])) ? $url_segments[0] : "Home";
		// $this -> method = (isset($url_segments[1]) && !empty($url_segments[1])) ? $url_segments[1] : "index";
		$this -> method = (isset($url_segments[1]) && !empty($url_segments[1])) ? "details" : "index";
		$this -> param = (isset($url_segments[2]) && !empty($url_segments[2])) ? $url_segments[2] : "";
	}
	
	public function getController(){
		return $this -> controller;
	}
	public function getMethod(){
		return $this -> method;
	}
	public function getParams(){
		return $this -> params;
	}
}

?>