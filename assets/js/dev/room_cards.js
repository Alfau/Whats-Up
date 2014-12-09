function rooms_cards(ResortID){
	$("main").append("<div id='rooms_cards_container'></div>");
	
	title("div#rooms_cards_container","Rooms","regular");
	
	$.each(JSONobj[model[1]][0],function( key, value ){
		if(value.ResortID === ResortID){
			render_rooms_cards("div#rooms_cards_container", value.Image, value.RoomType, value.Overview);
		}
	});
}

function render_rooms_cards(container,image,type,overview){
	$(container).append(
	"<div class='container'>"
+		"<div>"
+			"<div>"
+				"<img src='"+ baseURL + image +"'/>"
+			"</div>"
+			"<div>"
+				"<span class='emphasis_large'>"+ type +"</span>"
+				"<p class='summary'>"+ overview +"</p>"
+				"<div class='fade'><a href=# class='more'>Expand</a></div>"
+			"</div>"
+		"</div>"
+	"</div>").children(".container").fadeIn();
}