<?php  

class urlParse{
	protected $controller;
	protected $method;
	protected $params;
	
	function __construct(){
		$url = $_GET['url'];
		$split = explode("/",$url);
		
		$this -> controller = (isset($split[4]) && !empty($split[4])) ? $split[4] : "Home";
		$this -> method = (isset($split[5]) && !empty($split[5])) ? "details" : "index";
		$this -> params = (isset($split[0])) ? $split : array();
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