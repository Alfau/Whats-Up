function small_cards( href ){
	$("main").html("<div id='small_cards_container'></div>");

	var heading = href.toLowerCase().replace(/\b[a-z]/g, function( result ) { //can be made to a function
	    return result.toUpperCase();
	});
	
	title("div#small_cards_container",heading,"alternate");
	
	$.each(JSONobj[model[0]][0],function( key, value ){
		render_small_cards("div#small_cards_container", href, value.ID, value.Image, value.Name, value.Price, value.Overview, value.Duration);
	});
}

function render_small_cards( container, href, ID, image, name, price, overview, duration, direction ){
	
	if(direction === "rightt"){
		var margin = "100px";
	}else{
		var margin = "-100px";
	}
	
	$(container).append(
	"<div class='container'>"
+	"<div>"
+	"<a href='"+ href+"/"+name +"/"+ID+"' data-id='"+ ID +"' data-req='"+href+"_details'>"
+	"<div>"
+	"<img src='"+ image +"'/>"
+	(price == undefined ? "" : "<span class='emphasis_small'>From <b>USD "+ price +"</b></span>")
+	"</div>"
+	"<div>"
+	"<span class='emphasis_large'>"+ name +"</span>"
+	"<p class='summary'>"+ overview +"</p>"
+	"<div class='fade'></div>"
+	"</div>"
+	"</a>"
+	"<div>"
+	"<img src='assets/icons/Duration.svg' height='15'/><span class='smallest'>"+ duration +" days</span>"
+	"<div class='social'>"
+	"<a href=# class='facebook'></a>"
+	"<a href=# class='twitter'></a>"
+	"</div>"
+	"</div>"
+	"</div>"
+	"</div>").children(':last').css("margin-left", margin).animate({"opacity" : "1","margin-left" : "0"},700);

	getSVG("assets/icons/facebook.svg",container+" .social a.facebook");
	getSVG("assets/icons/twitter.svg",container+" .social a.twitter");
}