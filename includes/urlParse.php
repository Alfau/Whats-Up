<?php  

class urlParse{
	protected $controller;
	protected $method;
	protected $params;
	
	function __construct(){
		$split = explode("/",$_SERVER['REQUEST_URI']);
		
		$this -> controller = (isset($split[2]) && !empty($split[2])) ? $split[2] : "Home";
		$this -> method = (isset($split[3])) ? $split[3] : "index";
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