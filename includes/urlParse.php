<?php  

class urlParse{
	protected $controller;
	protected $method;
	protected $params;
	
	function __construct(){
		$split = explode("/",$_SERVER['REQUEST_URI']);
		
		$this -> controller = ($x = array_shift($split)) ? $x : "Home";
		$this -> method = ($x = array_shift($split)) ? $x : "index";
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