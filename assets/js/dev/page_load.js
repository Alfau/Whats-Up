function pageLoad(){
	$("main").children().fadeOut(function(){
		$(this).remove();
	});
	
	var url = window.location.href;
	var href = url.split(baseURL);
	
	var segments = href[1].split("/");
	
	if(segments[1] && segments[1] !== ""){
		model = segments[0]+"_details";
		object_ID = segments[2];
	}else{
		model = segments[0];
	}
	
	if(model.indexOf("_details") <= -1){
		var model = model.toLowerCase().replace(/\b[a-z]/g, function(result) {
			return result.toUpperCase();
		});
	}
	if(!model){
		model = "Home";
	}
	
	window.history.pushState("","Title",baseURL+href[1]);

	var req = model;

	if(model.indexOf("_details") > -1){
		handle(req_models[req], url, href[1], model, object_ID);
	}else{
		handle(req_models[req], url, segments[0], model, null);
	}
}