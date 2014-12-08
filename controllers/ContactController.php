<?php 
require_once("includes/connect.php");
require_once("models/Contact.php");

class ContactController{
	
	public function index(){
		
		$contact = new Contact();
		$contact = $contact -> getContact("All");
		
		$contactBundle = array("Contact" => $contact);
		
		$contactBundle = json_encode($contactBundle);
		
		$view = new View();
		$view = $view -> render("_views",array("Contact" => $contactBundle));
	}
	
}

?>