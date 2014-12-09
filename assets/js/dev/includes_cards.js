function includes_cards(ID){
	$("main").append("<div id='includes_cards_container'></div>");
	
	title("div#includes_cards_container","Includes","regular");
	
	$.each(JSONobj[model[0]][0],function( key, value ){
		if(value.ID === ID){
			render_includes_cards("div#includes_cards_container", value.Includes);
		}
	});
}

function render_includes_cards(container,includes){
	$(container).append(
	"<div class='container'>"
+		"<div>"
+			"<div class='emphasis_medium'>"+ includes
+			"<div class='fade'><a href=# class='more'>Expand</a></div>"
+			"</div>"
+		"</div>"
+	"</div>").children(".container").fadeIn();
}