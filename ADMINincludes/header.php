<?php include_once "ADMINmodels/Navigation.php" ?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/admin.css"/>
    <!-- <script src="script.js"></script> -->
    <!-- <script src="GGS.js"></script> -->
  </head>
  <body>
    <header>
    	<div id="logo"><a href=# id="logo">Admin Dashboard</a></div>
    	<ul>
		<?php
			$MainNav=new Navigation();
			$navLinks=$MainNav->getNavigation();
			
			foreach($navLinks as $value){
				?>
					<li><a href=#><?php echo $value['Name'] ?></a></li>
				<?php
			}
		?>
		</ul>
    </header>
    <main>