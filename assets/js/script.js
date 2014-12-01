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
			basicPage(model,url);
		}else{
			if(href.indexOf("home") > -1){
				homePage(url,req_models['home']);
			}else{
				handle(req_models[req],url,href,"small_cards",null);
			}
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
	
	$(document).on("click","div#featuredPackages_section #controls a",function(e){
		var page=$(this).attr("data-page");
		packagesCarousel(baseURL+"/home","Featured",page,"4");
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
	homePage(baseURL+"/home",req_models['home']);
	slideshow(9000,500);
	
});

var baseURL = getBaseURL();

var req_models = {
	Home : ["Slideshow", "Packages", "Quotes"],
	Packages : ["Packages"],
	Stay : ["Resorts", "Packages"],
	stay_details : ["Resorts", "Rooms"]
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

function packagesCarousel(url,state,page,rows){
	if(typeof JSONobj['Packages'] !== "undefined" && JSONobj['Packages'].length){
		packagesCarouselHandler(state,page,rows);
	}else{
		$.getJSON("JSONroute.php",{url:url},function(data){
			JSONobj['Packages']=data;
			packagesCarouselHandler(state,page,rows);
		});
	}
}
function packagesCarouselHandler(state,page,rows){
	start_key=((page-1)*rows);
	end_key=start_key+rows-1;
	
	$("div#featured_packages .container").fadeOut().remove();
	$.each(JSONobj['Packages'],function(key,value){
		if(value.State == state && key>=start_key && key<=end_key){
			cards("featured_packages",value.ID,"packages",value.Image,value.Name,value.Price,value.Overview,value.Duration,"duration");
		}
	});
}

function homePage(url,model){
	
	function JSONconfirm(i){
		var key = i || 0;
		if(key < model.length){
			if(typeof JSONobj[model[key]] === "undefined" || JSONobj[model[key]].length < 1){
				$.getJSON("JSONroute.php",{url:url},function(data){
					JSONobj=data;
					JSONconfirm(key+1);
				});
			}else{
				JSONconfirm(key+1);
			}
		}else{
			homePageHandler(url);
		}
	}
	
	JSONconfirm();
}

function homePageHandler(url){
	$("main").append("<div id='slideshow'><ul id='controls'></ul><ul id='slides'></ul><div>");
	$("main").append("<div id='featuredPackages_section'><div id='featured_packages'></div><ul id='controls'><li><a href=# data-page='1'></a></li><li><a href=# data-page='2'></a></li></ul><div>");
	$("main").append("<div id='customer_quote'><ul id='controls'></ul><div class='quote_container'></div></div>");
	
	
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
	$("div#featuredPackages_section").before(
		'<div class="heading_strip">'
	+	'<div class="heading_wrapper">'
	+	'<h3 class="heading">Featured <b>Packages</b></h3>'
	+	'</div>'
	+	'</div>'
	);
	
	packagesCarousel(url,"Featured","1","4");
}

function handle(model,url,href,type,object_ID){
	this.model = model;
	this.url = url;
	this.href = href;
	this.type = type;
	this.object_ID = object_ID;
	
	this.JSONconfirm = function(i){
		
		// console.log(model);
		
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
+	"<div>"
+	"<a href=#><?php include('../icons/facebook.svg') ?></a>"
+	"<a href=#><?php include('../icons/twitter.svg') ?></a>"
+	"</div>"
+	"</div>"
+	"</div>"
+	"</div>").children(".container").fadeIn();
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
+				(price == undefined ? "" : "<span class='emphasis_small'>From <b>USD "+ price +"</b></span>")
+			"</div>"
+			"<div>"
+				"<span class='emphasis_large'>"+ name +"</span>"
+				"<p class='summary'>"+ overview +"</p>"
+			"</div>"
+		"</div>"
+	"</div>").children(".container").fadeIn();

	rooms_cards(ID);
}

function rooms_cards(ResortID){
	$("main").append("<div id='rooms_cards_container'></div>");
	
	title("div#rooms_cards_container","Rooms","regular");
	
	$.each(JSONobj[model[1]],function( key, value ){
		if(value.ID === ResortID){
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

function basicPage(){
	this.JSONconfirm();
	
	$.each(JSONobj[model],function(key,value){
		var content = value.Text;
		title(value.Title,"alternate");
		basic(content,"emphasis_small");
	});
}
basicPage.prototype = new handle();


// function basicPageHandler(model){	
	// $.each(JSONobj[model],function(key,value){
		// var content = value.Text;
		// title(value.Title,"alternate");
		// basic(content,"emphasis_small");
	// });
// }

function title(below,title,type){
	$(below).before('<div class="heading_strip '+ type +'">'
+	'<div class="heading_wrapper">'
+	'<h3 class="heading">'+ title +'</b></h3>'
+	'</div>'
+	'</div>');
}

function basic(content,type){
	$("main").append(
	'<div class="gutter_space '+ type +'">'
+	'<div class="white_contain">'+ content +'</div>'
+	'</div>');
}

function detailsPage(model,url,href){
	function JSONconfirm(i){
		var key = i || 0;
		if(key < model.length){
			if(typeof JSONobj[model[key]] === "undefined" || JSONobj[model[key]].length < 1){
				$.getJSON("../JSONroute.php",{url:url},function(data){
					JSONobj[model[key]] = data;
					JSONconfirm(key+1);
				});
			}else{
				JSONconfirm(key+1);
			}
		}else{
			detailsPageHandler(model,href);
		}
	}
	
	JSONconfirm();
}

function detailsPageHandler(model,href){
	$("main").html("<div id='stay_details'></div>");
	
	var heading = href.toLowerCase().replace(/\b[a-z]/g, function(result) { //can be made to a function
	    return result.toUpperCase();
	});
	
	title("Overview","alternate");
	
	$.each(JSONobj[model[0]],function(key,value){
		//cards("cards_container",value.ID,href,value.Image,value.Name,value.Price,value.Overview,value.Duration,icon);
	});
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