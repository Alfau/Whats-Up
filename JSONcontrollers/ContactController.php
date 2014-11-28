<?php 
require_once("includes/connect.php");
require_once("models/Contact.php");

class ContactController{
	
	public function index(){
		
		$contact = new Contact();
		$contact = $contact -> getContact("SELECT * FROM contact");
		
		echo json_encode($contact);
		
	}
	
}

?>