<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>What's Up? Maldives</title>
	<link rel="stylesheet" type="text/css" href="style_2.css">
	<script src="jquery-1.11.1.min.js"></script>
	<script src="script.js"></script>
	<!-- <script src="GGS.js"></script> -->
</head>
<body>
	<header id="large">
		<div id="header_top">
			<a href=#><img src="Icons/logo.svg" alt="What's Up? Maldives"/></a>
			<ul>
				<li><a href=#><?php include("Icons/instagram.svg"); ?></a></li>
				<li><a href=#><?php include("Icons/twitter.svg"); ?></a></li>
				<li><a href=#><?php include("Icons/facebook.svg"); ?></a></li>
			</ul>
			<a href=# id="menu"><?php include("Icons/menu.svg") ?></a>
		</div>
		<div id="header_bottom">
			<nav id="left">
				<ul>
					<li><a href=# data-hover="Home">Home</a></li>
					<li><a href=# data-hover="Packages">Packages</a></li>
					<li><a href=# data-hover="Stay">Stay</a></li>
					<li><a href=# data-hover="Experience">Experience</a></li>
					<li class="nav_book"><a href=# data-hover="Book">Book <b>Now</b></a></li>
				</ul>
			</nav>
			<nav id="right">
				<ul>
					<li><a href=#>About</a></li>
					<li><a href=#>Contact</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<header id="small">
		 <nav id="left">
			<ul>
				<li><a href=#>Home</a></li>
				<li><a href=#>Packages</a></li>
				<li><a href=#>Stay</a></li>
				<li><a href=#>Experience</a></li>
				<li class="nav_book"><a href=#>Book Now</a></li>
			</ul>
		</nav>
		<a href=#><img src="Icons/logo.svg" alt="What's Up? Maldives"/></a>
		<div id="header_right">
			<nav id="right">
				<ul>
					<li><a href=#>About</a></li>
					<li><a href=#>Contact</a></li>
				</ul>
			</nav>
			<ul>
				<li><a href=#><?php include("Icons/instagram.svg"); ?></a></li>
				<li><a href=#><?php include("Icons/twitter.svg"); ?></a></li>
				<li><a href=#><?php include("Icons/facebook.svg"); ?></a></li>
			</ul>
		</div>
	</header>
	
	<main>
		<div id="slideshow">
			<ul id="controls">
				<li><a href=# class="active" data-id="1"></a></li>
				<li><a href=# data-id="2"></a></li>
			</ul>
			<ul id="slides">
				<li class="active" data-id="1">
					<div class="slide" style="background:url('Slides/slide_1.jpg');"></div>
					<div class="text">
						<p class="emphasis_large">Sheraton Maldives</p>
						<p class="emphasis_small">Your concierge through white sandy beaches of the Maldives</p>
					</div>
				</li>
				<li data-id="2">
					<div class="slide" style="background:url('Slides/slide_2.jpg');"></div>
					<div class="text">
						<p class="emphasis_large">Reethi Rah Resort</p>
						<p class="emphasis_small">Be Pampered</p>
					</div>
				</li>
			</ul>
		</div>
		<div class="heading_strip">
			<div class="heading_wrapper">
				<h3 class="heading">Featured <b>Packages</b></h3>
				<?php //include("Icons/sort.svg") ?>
			</div>
		</div>
		<div id="featured_packages">
			<div class="container">
				<div>
					<a href=#>
						<div>
							<img src="Packages/brasserie-471.jpg"/>
							<span class="emphasis_small">From <b>USD 300</b></span>
						</div>	
						<div>
							<span class="emphasis_large">Premium Luxury Package</span>
							<p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pulvinar neque sit amet viverra elementum. Ut mi libero,</p>
						</div>
					</a>
					<div>
						<img src="Icons/duration.svg" height="15"/><span class="smallest">5 DAYS</span>
						<div>
							<a href=#><?php include("Icons/twitter.svg"); ?></a>
							<a href=#><?php include("Icons/facebook.svg"); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div>
					<a href=#>
						<div>
							<img src="Packages/brasserie-471.jpg"/>
							<span class="emphasis_small">From <b>USD 300</b></span>
						</div>
						<div>
							<span href=# class="emphasis_large">Premium Luxury Package</span>
							<p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pulvinar neque sit amet viverra elementum. Ut mi libero,</p>
						</div>
					</a>
					<div>
						<img src="Icons/duration.svg" height="15"/><span class="smallest">5 DAYS</span>
						<div>
							<a href=#><?php include("Icons/twitter.svg"); ?></a>
							<a href=#><?php include("Icons/facebook.svg"); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div>
					<a href=#>
						<div>
							<img src="Packages/brasserie-471.jpg"/>
							<span class="emphasis_small">From <b>USD 300</b></span>
						</div>
						<div>
							<span class="emphasis_large">Premium Luxury Package</span>
							<p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pulvinar neque sit amet viverra elementum. Ut mi libero,</p>
						</div>
					</a>	
					<div>
						<img src="Icons/duration.svg" height="15"/><span class="smallest">5 DAYS</span>
						<div>
							<a href=#><?php include("Icons/twitter.svg"); ?></a>
							<a href=#><?php include("Icons/facebook.svg"); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div>
					<a href=#>
						<div>
							<img src="Packages/brasserie-471.jpg"/>
							<span class="emphasis_small">From <b>USD 300</b></span>
						</div>
						<div>
							<span class="emphasis_large">Premium Luxury Package</span>
							<p class="summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pulvinar neque sit amet viverra elementum. Ut mi libero,</p>
						</div>
					</a>
					<div>
						<img src="Icons/duration.svg" height="15"/><span class="smallest">5 DAYS</span>
						<div>
							<a href=#><?php include("Icons/twitter.svg"); ?></a>
							<a href=#><?php include("Icons/facebook.svg"); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>
</html>
