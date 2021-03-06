<?php 
require_once "models/Navigation.php";
require_once "../includes/paths.php";
?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/whatsup/assets/css/admin.css"/>
    <script src="/whatsup/assets/js/jquery-1.11.1.min.js"></script>
    <script src="/whatsup/assets/js/admin.js"></script>
    <!-- <script src="GGS.js"></script> -->
  </head>
  <body>
    <header>
    	<div id="logo"><a href="<?php echo URL::base()."admin" ?>" id="logo">Admin Dashboard</a><a href="logout" class="logout">Logout</a></div>
    	<ul>
		<?php
			$MainNav=new AdminNavigation();
			$navLinks=$MainNav->getNavigation();
			
			foreach($navLinks as $value){
				?>
					<li><a href="<?php echo URL::base() . "admin/" . $value['Name'] ?>"><?php echo $value['Name'] ?></a></li>
				<?php
			}
		?>
		</ul>
    </header>
    <main>