<?php include "includes/header.php" ?>

<div id="slideshow">
<?php

include_once("controllers/HomeController.php");

$slideshow = new HomeController();
$slideshow = $slideshow->slideshow();

echo "<ul id='controls'>";
foreach($slideshow as $key=>$value){
echo "<li><a href=# data-id='".$value['ID']."' class='";if($key==0){echo "active";}else{echo "";} echo "'></a></li>"; 	
}
echo "</ul>";

echo "<ul id='slides'>";
foreach($slideshow as $key=>$value){
echo "<li data-id='".$value['ID']."' class='";if($key==0){echo "active";}else{echo "";} echo "'>"
.	 "<div class='slide' style='background:url(\"".$value['Image']."\")'></div>"
.	 "<div class='text'>"
.	 "<p class='emphasis_large'>".$value['Title']."</p>"
.	 "<p class='emphasis_small'>".$value['Text']."</p>"
.	 "<a href=# class='details'>Details</a>"
.	 "</div>"
.	 "</li>";
}
echo "</ul>";

?>
</div>

<div class="heading_strip">
<div class="heading_wrapper">
<h3 class="heading">Featured <b>Packages</b></h3>
</div>
</div>

<div class="section" id="featuredPackages_section">
<div id="featured_packages">
<?php  

$packages = new HomeController();
$packages = $packages -> packages();

foreach($packages as $key=>$value){
echo "<div class='container'>"
.	 "<div>"
.	 "<a href=#>"
.	 "<div>"
.	 "<img src='".$value['Image']."'/>"
.	 "<span class='emphasis_small'>From <b>USD ".$value['Price']."</b></span>"
.	 "</div>"
.	 "<div>"
.	 "<span class='emphasis_large'>".$value['Name']."</span>"
.	 "<p class='summary'>".$value['Overview']."</span>"
.	 "</div>"
.	 "</a>"
.	 "<div>"
.	 "<img src='assets/icons/duration.svg' height='15'/><span class='smallest'>".$value['Duration']."</span>"
.	 "<div>"
.	 "<a href=#>"; include ('assets/icons/twitter.svg'); echo "</a>"
.	 "<a href=#>"; include ('assets/icons/facebook.svg'); echo "</a>"
.	 "</div>"
.	 "</div>"
.	 "</div>"
.	 "</div>"; 
}

?>
</div>
<ul id="controls">
<li><a href=# data-page="2"><?php include 'assets/icons/arrow.svg' ?></a></li>
<li><a href=# data-page="1"><?php include 'assets/icons/arrow.svg' ?></a></li>
</ul>
</div>

<?php include "includes/footer.php" ?>
