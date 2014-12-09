function render_home(url){
	$("main").append("<div id='slideshow'><ul id='controls'></ul><ul id='slides'></ul><div>");
	$("main").append("<div id='carousel_section' class='carousel_packages'><div id='carousel'></div><ul id='controls'><li><a href=# data-func='next'></a></li><li><a href=# data-func='prev'></a></li></ul><div>");
	$("main").append("<div id='customer_quote'><ul id='controls'></ul><div class='quote_container'></div></div>");
	
	getSVG("assets/icons/arrow.svg","div#carousel_section #controls a");
	
	var home_slideshow = new slideshow("div#slideshow", JSONobj["Slideshow"][0], 9000, 500);
	var featured_packages = new carousel_obj( "div#carousel_section", JSONobj["Packages"][0], 4, "State", "Featured", "packages" );
	
	$.each(JSONobj['Quotes'][0],function(key,value){
		key == 0 ? state = "active" : state = "inactive";
		
		$("div#customer_quote #controls").append(
		"<li><a href=# data-id='"+ value.ID +"' class='"+ state +"'></a></li>"
		);
		
		$("div#customer_quote .quote_container").append(
		"<div data-id='"+ value.ID +"' class='"+ state +"'>"
	+	"<p class='emphasis_large'>"+ value.Text +"</p>"
	+	"<p class='summary'>"+ value.Name +"</p>"
	+	"</div>"
		);
	});
	
	$("div#customer_quote").before(
		'<div class="heading_strip">'
	+	'<div class="heading_wrapper">'
	+	'<h3 class="heading">Customer <b>Feedback</b></h3>'
	+	'</div>'
	+	'</div>'
	);
	
	$("div#carousel_section").before(
		'<div class="heading_strip" style="margin-top:0">'
	+	'<div class="heading_wrapper">'
	+	'<h3 class="heading">Featured <b>Packages</b></h3>'
	+	'</div>'
	+	'</div>'
	);
}