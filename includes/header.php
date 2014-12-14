<?php include_once "models/Navigation.php" ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>What's Up? Maldives</title>
	<link rel="stylesheet" type="text/css" href="/whatsup/assets/css/style.min.css">
	<script src="/whatsup/assets/js/jquery-1.11.1.min.js"></script>
	<script src="/whatsup/assets/js/main.min.js"></script>
	<!-- <script src="assets/js/GGS.js"></script> -->
</head>
<body>	
	<header id="large">
		<div id="header_top">
			<a href=#><img src="/whatsup/assets/icons/logo.svg" alt="What's Up? Maldives"/></a>
			<ul>
				<?php
					$SocialNav=new Navigation();
					$navLinks=$SocialNav->getNavigation("SELECT * FROM navigation WHERE Position = '3'");
					
					foreach($navLinks[0] as $value){
						?>
							<li><a href=#><?php include($value['Image']) ?></a></li>
						<?php
					}
				?>
			</ul>
			<a href=# id="menu"><?php include("assets/icons/menu.svg") ?></a>
		</div>
		<div id="header_bottom">
			<nav id="left">
				<ul>
					<?php
						$MainNav=new Navigation();
						$navLinks=$MainNav->getNavigation("SELECT * FROM navigation WHERE Position = '1'");
						
						foreach($navLinks[0] as $value){
							if($value['HREF'] == "/book"){
							?>
								<li><a href=# class="book" data-req="<?php echo $value['Name'] ?>"><?php echo $value['Name'] ?></a></li>
							<?php
							}
							?>
								<li><a href=#><?php echo $value['Name'] ?></a></li>
							<?php
						}
					?>
				</ul>
			</nav>
			<nav id="right">
				<ul>
					<?php
						$SideNav=new Navigation();
						$navLinks=$SideNav->getNavigation("SELECT * FROM navigation WHERE Position = '2'");
						
						foreach($navLinks[0] as $value){
							?>
								<li><a href=#><?php echo $value['Name'] ?></a></li>
							<?php
						}
					?>
				</ul>
			</nav>
		</div>
	</header>
	<header id="small">
		 <nav id="left">
			<ul>
				<?php
					$MainNav=new Navigation();
					$navLinks=$MainNav->getNavigation("SELECT * FROM navigation WHERE Position = '1'");
					
					foreach($navLinks[0] as $value){
						if($value['HREF'] == "book"){
						?>
							<li><a href="<?php echo $value['HREF'] ?>" class="book" data-req="<?php echo $value['Name'] ?>"><?php echo $value['Name'] ?></a></li>
						<?php
						}else{
						?>
							<li><a href="<?php echo $value['HREF'] ?>" data-req="<?php echo $value['Name'] ?>"><?php echo $value['Name'] ?></a></li>
						<?php
						}
					}
				?>
			</ul>
		</nav>
		<a href=#><img src="/whatsup/assets/icons/logo.svg" alt="What's Up? Maldives"/></a>
		<div id="header_right">
			<nav id="right">
				<ul>
					<?php
						$SideNav=new Navigation();
						$navLinks=$SideNav->getNavigation("SELECT * FROM navigation WHERE Position = '2'");
						
						foreach($navLinks[0] as $value){
							?>
								<li><a href="<?php echo $value['HREF'] ?>" data-req="<?php echo $value['Name'] ?>"><?php echo $value['Name'] ?></a></li>
							<?php
						}
					?>
				</ul>
			</nav>
			<ul>
				<?php
					$SocialNav=new Navigation();
					$navLinks=$SocialNav->getNavigation("SELECT * FROM navigation WHERE Position = '3'");
					
					foreach($navLinks[0] as $value){
						?>
							<li><a href=#><?php include($value['Image']) ?></a></li>
						<?php
					}
				?>
			</ul>
		</div>
		<a href=# id="menu"><?php include("assets/icons/menu.svg") ?></a>
	</header>
		<main>