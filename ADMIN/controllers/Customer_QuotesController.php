<?php  
require_once("../includes/connect.php");
require_once("../models/Quotes.php");
require_once("../includes/view.php");

class Customer_QuotesController{
	
	function index(){
		
		$customer_quotes = new Quotes();
		$customer_quotes = $customer_quotes -> getQuotes();
		
		$view = new View();
		$view = $view -> render("customer_quotes",array("data" => $customer_quotes));

	}
	
	function edit($id){
		
		$customer_quotes = new Quotes();
		$customer_quotes = $customer_quotes -> getQuotes("SELECT * FROM customer_quotes WHERE ID = $id");
		
		$view = new View();
		$view = $view -> render("customer_quotes_edit",array("data" => $customer_quotes));
	}
	
	function delete($id){
		$customer_quotes = new Quotes();
		$customer_quotes = $customer_quotes -> deleteQuotes($id);
		
		$view = new View();
		$view = $view -> render("customer_quotes",array("data" => $customer_quotes[0], "delete_status" => $customer_quotes[1]));
	}
	
}

?>