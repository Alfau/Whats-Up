<?php 
session_start();

require_once "../includes/paths.php";

if(isset($_SESSION['Username'])){
	header("Location:".URL::base()."/admin");
	exit();
}

?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/whatsup/assets/css/admin.css"/>
    <script src="/whatsup/assets/js/jquery-1.11.1.min.js"></script>
    <script src="/whatsup/assets/js/admin.js"></script>
  </head>
  <body>
    <div class="authenticate">
		<form method="POST" action="../admin/sessions/authentication">
			<input type="text" name="Username" placeholder="Username"/><input type="password" name="Password" placeholder="Password"/><input type="submit" value="Log In"/>
		</form>
		<?php
			if(isset($data)){
				echo "<p class='status'>".$data["status"]."</p>";
			}
		?>
	</div>
  </body> 
</html>

<?php

$url = URL::current();
$base = URL::base();

$url = explode($base, $url);

echo $url[1];

?>