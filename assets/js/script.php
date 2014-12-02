$(document).ready(function(){
	$(document).on("click","a#menu",function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active").children("svg").attr("class","");
			// $("header#large div#header_bottom").slideUp();
			 $("header#large div#header_bottom").css({"margin-left":"100%"});
		}else{
			$(this).addClass("active").children("svg").attr("class","active");
			// $("header#large div#header_bottom").slideDown();
			$("header#large div#header_bottom").css({"margin-left":"0"});
		}
	});
	
	$(document).on("click","nav a",function(e){
		$("main").children().fadeOut(function(){
			$(this).remove();
		});
		
		var href = $(this).attr("href");
		var model = href.toLowerCase().replace(/\b[a-z]/g, function(result) { //can be made to a function
		    return result.toUpperCase();
		});
		
		var url = $(this).prop("href");
		window.history.pushState("","Title",baseURL+href);
		
		var req = $(this).attr("data-req");
		
		if($(this).parents("nav#right").length){
			// basicPage(model,url);
			handle(req_models[req],url,href,"basic_cards",null);
		}else{
			href.indexOf("home") > -1 ? handle(req_models[req],url,href,"render_home",null) : handle(req_models[req],url,href,"small_cards",null);	
		}
		
		e.preventDefault();
	});
	
	$(document).on("click","div#small_cards_container a",function(e){
		$("main").children().fadeOut(function(){
			$(this).remove();
		});
		
		var href = $(this).attr("href");
		var model = href.toLowerCase().replace(/\b[a-z]/g, function(result) { //can be made to a function
		    return result.toUpperCase();
		});
		
		var url = $(this).prop("href");
		window.history.pushState("","Title",baseURL+href);
		
		var req = $(this).attr("data-req");
		
		object_ID = $(this).attr("data-id");
		
		handle(req_models[req],url,href,"large_cards",object_ID);
		
		e.preventDefault();
	});
	
	$(document).on("click","div.carousel_packages #controls a",function(e){
		var page=$(this).attr("data-page");
		handle_carousel(["Packages"],baseURL+"packages","packages","Featured",page,"4");
		e.preventDefault();
	});
	
	$(document).on("click","div#customer_quote #controls a",function(e){
		var active=$("div#customer_quote .quote_container .active");
		var active_id=$(this).attr("data-id");
		
		$(active).animate({"opacity":0},150).removeClass("active");
		$("div#customer_quote div[data-id=" + active_id + "]").delay(200).animate({"opacity":1},150).addClass("active");
		$("div#customer_quote #controls a.active").css({"background-color":"#bfc0c2"}).removeClass("active");
		$("div#customer_quote #controls a[data-id=" + active_id + "]").css({"background-color":"#30bec1"}).addClass("active");
		
		e.preventDefault();
	});
	
	$(document).on("click","main a",function(e){
		
		
		e.preventDefault();
	});
	
	JSONobj = {};
	handle(req_models["Home"],baseURL+"home","home","render_home",null);
	slideshow(9000,500);
	
});

var baseURL = getBaseURL();

var req_models = {
	Home : ["Slideshow", "Packages", "Quotes"],
	Packages : ["Packages"],
	Stay : ["Resorts", "Packages"],
	About : ["About"],
	Contact : ["Contact"],
	stay_details : ["Resorts", "Rooms"],
	packages_details : ["Packages"]
};

function changeURL(url){
	window.history.pushState("","Title",url);
}

function slideshow(interval,speed){
	var trigger_slide=setInterval(slide,interval);
	
	function slide(){
		var active_id=$("div#slideshow li.active").attr("data-id");
		action(active_id,"interval");
	}
	
	$(document).on("click","div#slideshow #controls a",function(e){
		var active_id=$(this).attr("data-id");
		action(active_id,"control");
		
		clearInterval(trigger_slide);
		trigger_slide=setInterval(slide,interval);
		
		e.preventDefault();
	});
	
	function action(active_id,execute){
		var active=$("div#slideshow li.active");
		var control_active=$("div#slideshow #controls a.active");
		if(execute=="interval"){
			$(active).is(":last-child") ? active_id=1 : active_id++;
		}
		
		$(active).animate({"opacity":0},speed).removeClass("active").children(".text").animate({"opacity":0},speed/2);
		$("div#slideshow li[data-id=" + active_id + "]").animate({"opacity":1},speed).addClass("active").children(".text").animate({"opacity":1},speed/2);
		$(control_active).css({"background-color":"#fff"}).removeClass("active");
		$("div#slideshow #controls a[data-id=" + active_id + "]").css({"background-color":"#30bec1"}).addClass("active");
	}
}

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

function small_cards( href ){
	$("main").html("<div id='small_cards_container'></div>");

	var heading = href.toLowerCase().replace(/\b[a-z]/g, function( result ) { //can be made to a function
	    return result.toUpperCase();
	});
	
	title("div#small_cards_container",heading,"alternate");
	
	$.each(JSONobj[model[0]],function( key, value ){
		render_small_cards("div#small_cards_container", href, value.ID, value.Image, value.Name, value.Price, value.Overview, value.Duration);
	});
}

function render_small_cards( container, href, ID, image, name, price, overview, duration ){	
	$(container).append(
	"<div class='container'>"
+	"<div>"
+	"<a href='"+ href+"/"+name +"' data-id='"+ ID +"' data-req='"+href+"_details'>"
+	"<div>"
+	"<img src='"+ image +"'/>"
+	(price == undefined ? "" : "<span class='emphasis_small'>From <b>USD "+ price +"</b></span>")
+	"</div>"
+	"<div>"
+	"<span class='emphasis_large'>"+ name +"</span>"
+	"<p class='summary'>"+ overview +"</p>"
+	"</div>"
+	"</a>"
+	"<div>"
+	"<img src='assets/icons/Duration.svg' height='15'/><span class='smallest'>"+ duration +" days</span>"
+	"<div class='social'>"
+	"<a href=# class='facebook'><?php //include('../icons/facebook.svg') ?></a>"
+	"<a href=# class='twitter'><?php //include('../icons/twitter.svg') ?></a>"
+	"</div>"
+	"</div>"
+	"</div>"
+	"</div>").children(".container").fadeIn();

	getSVG("assets/icons/facebook.svg",container+" .social a.facebook");
	getSVG("assets/icons/twitter.svg",container+" .social a.twitter");
}

function large_cards( href ){
	$("main").html("<div id='large_cards_container'></div>");

	var heading = href.toLowerCase().replace(/\b[a-z]/g, function( result ) { //can be made to a function
	    return result.toUpperCase();
	});
	
	title("div#large_cards_container",heading.split("/")[1],"alternate");
	
	$.each(JSONobj[model[0]],function( key, value ){
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
+			"</div>"
+		"</div>"
+	"</div>").children(".container").fadeIn();

	console.log(ID);

	switch(href.split("/")[0]){
		case "stay" :
			rooms_cards(ID);
			break;
		case "packages" :
			includes_cards(ID);
			break;	
	}
}

function rooms_cards(ResortID){
	$("main").append("<div id='rooms_cards_container'></div>");
	
	title("div#rooms_cards_container","Rooms","regular");
	
	$.each(JSONobj[model[1]],function( key, value ){
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
+			"</div>"
+		"</div>"
+	"</div>").children(".container").fadeIn();
}

function includes_cards(ID){
	$("main").append("<div id='includes_cards_container'></div>");
	
	title("div#includes_cards_container","Includes","regular");
	
	$.each(JSONobj[model[0]],function( key, value ){
		if(value.ID === ID){
			render_includes_cards("div#includes_cards_container", value.Includes);
		}
	});
}

function render_includes_cards(container,includes){
	$(container).append(
	"<div class='container'>"
+		"<div>"
+			"<div class='emphasis_medium'>"+ includes +"</div>"
+		"</div>"
+	"</div>").children(".container").fadeIn();
}

function render_home(url){
	$("main").append("<div id='slideshow'><ul id='controls'></ul><ul id='slides'></ul><div>");
	$("main").append("<div id='carousel_section' class='carousel_packages'><div id='carousel'></div><ul id='controls'><li><a href=# data-page='1'></a></li><li><a href=# data-page='2'></a></li></ul><div>");
	$("main").append("<div id='customer_quote'><ul id='controls'></ul><div class='quote_container'></div></div>");
	
	getSVG("assets/icons/arrow.svg","div#carousel_section #controls a");
	
	$.each(JSONobj["Slideshow"],function(key,value){
		key == 0 ? state = "active" : state = "inactive";
		
		$("div#slideshow #controls").append(
		"<li><a href=# data-id='"+ value.ID +"' class='"+ state +"'></a></li>"
		);
		
		$("div#slideshow ul#slides").append(
		"<li data-id='"+ value.ID +"' class='"+ state +"'>"
	+	"<div class='slide' style='background:url(\""+ value.Image +"\")'></div>"
	+	"<div class='text'>"
	+	"<p class='emphasis_large'>"+ value.Title +"</p>"
	+	"<p class='emphasis_small'>"+ value.Text +"</p>"
	+	"<a href=# class='details'>Details</a>"
	+	"</div>"
	+	"</li>");
	});
	
	$.each(JSONobj['Quotes'],function(key,value){
		key == 0 ? state = "active" : state = "inactive";
		
		$("div#customer_quote #controls").append(
		"<li><a href=# data-id='"+ value.ID +"' class='"+ state +"'></a></li>"
		);
		
		$("div#customer_quote .quote_container").append(
		"<div data-id='"+ value.ID +"' class='"+ state +"'>"
	+	"<p class='emphasis_large'>"+ value.Text +"</p>"
	+	"<p class='summary'>"+ value.Name +"</p>"
	+	"</div>"
		);
	});
	
	$("div#customer_quote").before(
		'<div class="heading_strip">'
	+	'<div class="heading_wrapper">'
	+	'<h3 class="heading">Customer <b>Feedback</b></h3>'
	+	'</div>'
	+	'</div>'
	);
	$("div#carousel_section").before(
		'<div class="heading_strip">'
	+	'<div class="heading_wrapper">'
	+	'<h3 class="heading">Featured <b>Packages</b></h3>'
	+	'</div>'
	+	'</div>'
	);
	
	handle_carousel(["Packages"],baseURL+"packages","packages","Featured","1","4");
}

function basic_cards(){
	$("main").html("<div class='basic_cards_container'></div>");
	
	$.each(JSONobj[model[0]],function( key, value ){
		title("div.basic_cards_container", value.Title, "alternate");
		render_basic_cards(value.Text, "emphasis_small");
	});
}

function render_basic_cards(content,type){
	$("div.basic_cards_container").append('<div class="basic_cards '+ type +'">'+ content +'</div>');
}

function handle_carousel(model,url,href,state,page,rows){
	this.model = model;
	this.url = url;
	this.href = href;
	
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
			carousel(state,page,rows);
		}
	};
	JSONconfirm();
}

function carousel(state,page,rows){
	start_key=((page-1)*rows);
	end_key=start_key+rows-1;
	
	$("div#carousel .container").fadeOut().remove();
	$.each(JSONobj[model[0]],function(key,value){
		if(value.State == state && key>=start_key && key<=end_key){
			render_small_cards("div#carousel", href, value.ID, value.Image, value.Name, value.Price, value.Overview, value.Duration);
		}
	});
}

function title(below,title,type){
	$(below).before('<div class="heading_strip '+ type +'">'
+	'<div class="heading_wrapper">'
+	'<h3 class="heading">'+ title +'</b></h3>'
+	'</div>'
+	'</div>');
}

function getBaseURL() {
    var url = location.href;  // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));


    if (baseURL.indexOf('http://localhost') != -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL + "/";
    }

}

function getSVG(location,target){
	$.get(baseURL+location,function(data){
		$(target).html(data);
	},"text");
}
