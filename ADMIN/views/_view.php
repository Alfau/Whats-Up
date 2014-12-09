<?php 
session_start();

if(!isset($_SESSION['Username'])){
	header("Location:../admin/login");
	exit();
}

include("includes/header.php");
?>

<div class="wrapper">
	
<?php 
include("includes/data_display.php");
include("includes/data_add.php"); 
?>

</div>

<?php include("includes/footer.php");?>
