<?php  
require_once("../includes/connect.php");
require_once("../models/Quotes.php");
require_once("../includes/view.php");

class Customer_QuotesController{
	
	function index(){
		
		$customer_quotes = new Quotes();
		$customer_quotes = $customer_quotes -> getQuotes("SELECT * FROM customer_quotes");
		
		$view = new View();
		$view = $view -> render("customer_quotes",array("data" => $customer_quotes));

	}
	
}

?>