<?php 
require_once("includes/connect.php");
require_once("models/Contact.php");

class ContactController{
	
	public function index(){
		
		$contact = new Contact();
		$contact = $contact -> getContact("All");
		
		$contactBundle = array("Contact" => $contact);
		
		echo json_encode($contactBundle);
		
	}
	
}

?>