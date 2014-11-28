<?php

require_once("includes/connect.php");
require_once("JSONcontrollers/AboutController.php");
require_once("JSONcontrollers/PackagesController.php");
require_once("JSONcontrollers/ContactController.php");
require_once("JSONcontrollers/StayController.php");
require_once("JSONcontrollers/HomeController.php");

$model = $_GET['model'];
$method = $_GET['method'];

$packet = new $model();
$packet = $packet -> $method("SELECT * FROM ".strtolower($model));

echo json_encode($packet);

?>
