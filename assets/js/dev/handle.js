function handle(model,url,href,page,object_ID){
	this.model = model;
	this.url = url;
	this.href = href;
	this.page = page;
	this.object_ID = object_ID;
	
	this.JSONconfirm = function(i){
		var key = i || 0;
		if(key < model.length){
			if(typeof JSONobj[model[key]] === "undefined" || JSONobj[model[key]].length < 1){
				$.getJSON(baseURL+"/JSONroute.php",{url:url},function(data){
					$.each(data,function(key,value){
						JSONobj[key] = value;
					});
					JSONconfirm(key+1);
				});
			}else{
				JSONconfirm(key+1);
			}
		}else{
			render(this.page, this.href);
		}
	};
	
	JSONconfirm();
}

function render(page, href){
	switch(page){
		case "Home" : render_home(); break;
		
		case "Packages" :
		case "Stay" :
		case "Sights" : small_cards(href); break;
		
		case "About" :
		case "Contact" : basic_cards(); break;
		
		case "packages_details" :
		case "stay_details" : large_cards(href); break;
	}
}
