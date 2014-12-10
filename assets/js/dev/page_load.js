function pageLoad(){
	$("main").children().fadeOut(function(){
		$(this).remove();
	});
	
	var href = window.location.href;
	var href = href.split(baseURL);
	
	var segments = href[1].split("/");
	
	if(segments[1] && segments[1] !== ""){
		model = segments[0]+"_details";
		object_ID = segments[2];
	}else{
		model = segments[0];
	}
	
	if(model.indexOf("_details") <= -1){
		var model = model.toLowerCase().replace(/\b[a-z]/g, function(result) { //can be made to a function
			return result.toUpperCase();
		});
	}
	if(!model){
		model = "Home";
	}
	
	var url = window.location.href;
	window.history.pushState("","Title",baseURL+href[1]);

	var req = model;
	
	if(model.indexOf("_details") > -1){
		handle(req_models[req],url,href[1],"large_cards",object_ID);
	}
	else if(model.indexOf("Home") > -1){
		handle(req_models[req],url,segments[0],"render_home",null);
	}
	else if(model.indexOf("About") > -1 || model.indexOf("Contact") > -1){
		handle(req_models[req],url,segments[0],"basic_cards",null);
	}
	else{
		handle(req_models[req],url,segments[0],"small_cards",null);
	}
}