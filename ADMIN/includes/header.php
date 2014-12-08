<?php include_once "models/Navigation.php" ?>
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
  	<a href="#add" id="add_anchor">Add</a>
    <header>
    	<div id="logo"><a href=# id="logo">Admin Dashboard</a></div>
    	<ul>
		<?php
			$MainNav=new AdminNavigation();
			$navLinks=$MainNav->getNavigation();
			
			foreach($navLinks as $value){
				?>
					<li><a href="/whatsup/admin/<?php echo $value['Name'] ?>"><?php echo $value['Name'] ?></a></li>
				<?php
			}
		?>
		</ul>
    </header>
    <main>