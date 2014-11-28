<?php

require_once("includes/connect.php");
require_once("models/About.php");
require_once("models/Packages.php");
require_once("models/Contact.php");
require_once("models/Stay.php");

$model = $_GET['model'];
$method = $_GET['method'];

$packet = new $model();
$packet = $packet -> $method("SELECT * FROM ".strtolower($model));

echo json_encode($packet);

?>