<?php
class URL{
	
	static $baseURL = "http://localhost/whatsup/";
	
	public static function To($location){
		switch($location){
			case "/" :
			case "home" : $this -> baseURL; break;
			case "packages" : return self::$baseURL."packages/"; break;
			case "stay" : return self::$baseURL."stay/"; break;
			case "sights" : return self::$baseURLL."sights/"; break;
			case "about" : return self::$baseURL."about/"; break;
			case "contact" : return self::$baseURL."contact/"; break;
		}
	}
	
	public static function current(){
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if((substr($url, -1)) === "/"){
			return $url;
		}else{
			return $url."/";
		}
	}
	
	public static function base(){
		return self::$baseURL;
	}
}

?>