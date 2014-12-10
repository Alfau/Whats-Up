function pageLoad(){
	$("main").children().fadeOut(function(){
		$(this).remove();
	});
	
	// var href = window.location.pathname;
	// var href = href.split("/")[2];
	
	var href = window.location.href;
	var href = href.split(getBaseURL());
	
	var method = href[1].split("/");
	
	if(method[1] && method[1] !== ""){
		model = method[0]+"_details";
	}else{
		model = method[0];
	}
	// href= model[1];
	
	// var model = href.toLowerCase().replace(/\b[a-z]/g, function(result) { //can be made to a function
		// return result.toUpperCase();
	// });
	var model = model.toLowerCase().replace(/\b[a-z]/g, function(result) { //can be made to a function
		return result.toUpperCase();
	});
	if(!model){
		model = "Home";
	}
	
	if(model.indexOf("_details") > -1){
		model = model.toLowerCase();
	}
	
	if(model.indexOf("_details") > -1){
		console.log("good");
	}else{
		console.log("shuckds");
	}
	
	var url = window.location.href;
	window.history.pushState("","Title",baseURL+href[1]);

	var req = model;
	
	if(model.indexOf("_details") > -1){
		handle(req_models[req],url,href[1],"large_cards",object_ID);
	}
	else if(model.indexOf("home") > -1){
		handle(req_models[req],url,href[1],"render_home",null);
	}else if(model.indexOf("about") > -1 || model.indexOf("contact") > -1){
		handle(req_models[req],url,href[1],"basic_cards",null);
	}else{
		handle(req_models[req],url,href[1],"small_cards",null);
	}
}