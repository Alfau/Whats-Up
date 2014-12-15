<?php 
session_start();

require_once "../includes/paths.php";

if(!isset($_SESSION['Username'])){
	header("Location:".URL::base()."admin/login");
	exit();
}

include("includes/header.php");
?>
<a href="#add" id="add_anchor">Add</a>

<div class="wrapper">
	
<?php 
include("includes/data_display.php");
include("includes/data_add.php"); 
?>

</div>

<?php include("includes/footer.php");?>
