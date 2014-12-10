function handle(model,url,href,type,object_ID){
	this.model = model;
	this.url = url;
	this.href = href;
	this.type = type;
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
			render(this.type, this.href);
		}
	};
	JSONconfirm();
	
	console.log(this.href);
}

function render(type,href){
	switch(type){
		case "small_cards" :
			small_cards(href);
			break;
		case "large_cards" :
			large_cards(href);
			break;
		case "basic_cards" :
			basic_cards();
			break;	
		case "render_home" :
			render_home();
			break;
	}
}