function pageLoad(){
	$("main").children().fadeOut(function(){
		$(this).remove();
	});
	
	var href = window.location.pathname;
	var href = href.split("/")[2];
	
	var model = href.toLowerCase().replace(/\b[a-z]/g, function(result) { //can be made to a function
		return result.toUpperCase();
	});
	if(!model){
		model = "Home";
	}
	
	var url = window.location.href;
	window.history.pushState("","Title",baseURL+href);

	var req = model;
	
	if(href.indexOf("home") > -1){
		handle(req_models[req],url,href,"render_home",null);
	}else if(href.indexOf("about") > -1 || href.indexOf("contact") > -1){
		handle(req_models[req],url,href,"basic_cards",null);
	}else{
		handle(req_models[req],url,href,"small_cards",null);
	}
}