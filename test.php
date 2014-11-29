<?php include "includes/header.php" ?>

<div id="slideshow">
<?php

echo "<ul id='controls'>";

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

</div>

<ul id="controls">
<li><a href=# data-page="2"><?php include 'assets/icons/arrow.svg' ?></a></li>
<li><a href=# data-page="1"><?php include 'assets/icons/arrow.svg' ?></a></li>
</ul>
</div>

<div class="heading_strip">
<div class="heading_wrapper">
<h3 class="heading">Customer <b>Feedback</b></h3>
</div>
</div>

<div id="customer_quote">
<ul id="controls">

</ul>
<div class="quote_container">
<?php 
include("assets/icons/quote.svg");

include("assets/icons/quote.svg"); 
?>
</div>
</div>

<?php include "includes/footer.php" ?>
