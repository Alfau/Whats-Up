function large_cards( href ){
	$("main").html("<div id='large_cards_container'></div>");

	var heading = href.toLowerCase().replace(/\b[a-z]/g, function( result ) { //can be made to a function
	    return result.toUpperCase();
	});
	
	title("div#large_cards_container",heading.split("/")[1],"alternate");
	
	$.each(JSONobj[model[0]][0],function( key, value ){
		if(value.ID === object_ID){
			render_large_cards("div#large_cards_container", href, value.ID, value.Image, value.Name, value.Price, value.Overview, value.Duration);
		}
	});
}

function render_large_cards( container, href, ID, image, name, price, overview, duration ){
	$(container).append(
	"<div class='container'>"
+		"<div>"
+			"<div>"
+				"<img src='"+ baseURL + image +"'/>"
+			"</div>"
+			"<div>"
+				"<span class='emphasis_large'>"+ name +"</span>"
+				(price == undefined ? "" : "<span class='emphasis_medium'>From <b>USD "+ price +"</b></span>")
+				"<p class='summary'>"+ overview +"</p>"
+				"<div class='fade'><a href=# class='more'>Expand</a></div>"
+			"</div>"
+		"</div>"
+	"</div>").children(".container").fadeIn();

	switch(href.split("/")[0]){
		case "stay" :
			rooms_cards(ID);
			break;
		case "packages" :
			includes_cards(ID);
			break;	
	}
}