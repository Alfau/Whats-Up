<?php  
include("includes/connect.php");
include("models/Packages.php");

		
$packages = new Packages();
$packages = $packages->getPackages("SELECT * FROM packages");

$packages = json_encode($packages);

return $packages;		

?>