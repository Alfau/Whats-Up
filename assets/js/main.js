$(document).ready(function(){
	pageLoad();
	mobile_menu();
	nav_click();
	small_cards_click();
	quotes_control();
	cards_expand();
});
JSONobj = {};

var baseURL = getBaseURL();

var req_models = {
	Home : ["Slideshow", "Packages", "Quotes"],
	Packages : ["Packages"],
	Stay : ["Resorts", "Packages"],
	Sights : ["Sights"],
	About : ["About"],
	Contact : ["Contact"],
	stay_details : ["Resorts", "Rooms"],
	packages_details : ["Packages"],
	sights_details : ["Sights"]
};
var slideshow = function(container, slides, interval, speed){
	var self = this;
	var content = "";
	var controls = "";
	
	this.container = container;
	this.slides = slides;
	this.interval = interval;
	this.speed = speed;
	// this.slide_interval = setInterval(self.trigger, self.interval);
	
	this.init = function(){
		self.render();
		
		var slide_interval = setInterval(self.trigger, self.interval);
		
		$(document).on("click", self.container + " #controls a", function(e){
			var slide = $( this ).attr( "data-id" );
			self.slide( slide );
			
			clearInterval(slide_interval);
			slide_interval = setInterval(self.trigger, self.interval);
			
			// self.reset();
			
			e.preventDefault();
		});
	};
	
	this.trigger = function(){
		var current_active = $( "div#slideshow #slides li.active" );
		$( current_active ).is( ":last-child" ) ? next = 1 : next = parseInt( current_active.attr( "data-id" ) ) + 1;
	
		self.slide(next);
	};
	
	this.slide = function(id){
		$( self.container + " #slides li" ).animate({ "opacity" : 0 }, { duration: self.speed, queue: false }).removeClass( "active" );
		$( self.container + " #slides li[ data-id = " + id + "]" ).animate({ "opacity" : 1 }, { duration: self.speed, queue: false }).addClass( "active" );
		
		$( self.container + " #controls a").removeClass( "active" );
		$( self.container + " #controls a[ data-id = " + id + "]" ).addClass( "active" );
	};
	
	this.render = function(){
		$.each( self.slides, function(key, value){
			key === 0 ? state = "active" : state = "inactive";
			
			controls += "<li>"
			+	"<a href=# data-id='" + value.ID + "' class='" + state + "'></a>"
			+	"</li>";
			
			content += "<li data-id='" + value.ID + "' class='" + state + "'>"
			+	"<div class='slide' style='background:url(\"" + value.Image + "\")'></div>"
			+	"<div class='text'>"
			+	"<p class='emphasis_large'>" + value.Title + "</p>"
			+	"<p class='emphasis_small'>" + value.Text + "</p>"
			+	"<a href=# class='details'>Details</a>"
			+	"</div>"
			+	"</li>";
		});
		
		$( self.container + " #controls" ).append( controls );
		$( self.container + " #slides" ).append( content );
	};
	
	this.reset = function(){
		clearInterval(self.slide_interval);
		slide_interval = setInterval(self.trigger, self.interval);
	};
	
	this.init();
};
var carousel_obj = function(container, data, num_rows, filter_key, filter_val, href){
	var self = this;
	
	this.container = container;
	this.data = data;
	this.num_rows = num_rows;
	this.filter_key = filter_key;
	this.filter_val = filter_val;
	this.href = href;
	this.page = 1;	
	
	this.state = "State";
	
	this.init = function(){
		self.render_handle();
		self.control();
		self.anchor();
	};
	
	this.control = function(){
		var total_pages = self.data.length / self.num_rows;
		
		$( document ).on( "click", self.container + " #controls a", function(e){
			if( $(this).attr("data-func") === "next" ){
				if(self.page < ( total_pages )){
					self.page++;
					self.render_handle("left");
				}
			}else{
				if(self.page > 1){
					self.page--;
					self.render_handle("right");
				}
			}
			e.preventDefault();
		});
	};
	
	this.render_handle = function(direction){
		start_key = ((self.page - 1) * self.num_rows);
		end_key = start_key + self.num_rows - 1;
		
		$( self.container + " div#carousel .container" ).fadeOut().remove();
		
		$.each( self.data, function( key, value ){
			if( value[self.filter_key] === self.filter_val && key >= start_key && key <= end_key ){
				render_small_cards( "div#carousel", self.href, value.ID, value.Image, value.Name, value.Price, value.Overview, value.Duration, direction );
			}
		});
	};
	
	this.anchor = function(){
		$(document).on("click", this.container + " #carousel a",function(e){
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
			
			handle(req_models[req],url,href,req,object_ID);
			
			e.preventDefault();
		});
	};
	
	this.init();
};
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
		case "sights_details" :
		case "stay_details" : large_cards(href); break;
	}
}

function small_cards( href ){
	$("main").html("<div id='small_cards_container'></div>");
	 
	var heading = href.toLowerCase().replace(/\b[a-z]/g, function( result ) { //can be made to a function
	    return result.toUpperCase();
	});
	
	title("div#small_cards_container",heading,"alternate");
	
	$.each(JSONobj[model[0]][0],function( key, value ){
		render_small_cards("div#small_cards_container", href, value.ID, value.Image, value.Name, value.Price, value.Overview, value.Duration);
	});
}

function render_small_cards( container, href, ID, image, name, price, overview, duration, direction ){
	
	if(direction === "rightt"){
		var margin = "100px";
	}else{
		var margin = "-100px";
	}
	
	$(container).append(
	"<div class='container'>"
+	"<div>"
+	"<a href='"+ href+"/"+name +"/"+ID+"' data-id='"+ ID +"' data-req='"+href+"_details'>"
+	"<div>"
+	"<img src='/whatsup/"+ image +"'/>"
+	(price == undefined ? "" : "<span class='emphasis_small'>From <b>USD "+ price +"</b></span>")
+	"</div>"
+	"<div>"
+	"<span class='emphasis_large'>"+ name +"</span>"
+	"<p class='summary'>"+ overview +"</p>"
+	"<div class='fade'></div>"
+	"</div>"
+	"</a>"
+	"<div>"
+	"<img src='/whatsup/assets/icons/Duration.svg' height='15'/><span class='smallest'>"+ duration +" days</span>"
+	"<div class='social'>"
+	"<a href=# class='facebook'></a>"
+	"<a href=# class='twitter'></a>"
+	"</div>"
+	"</div>"
+	"</div>"
+	"</div>").children(':last').css("margin-left", margin).animate({"opacity" : "1","margin-left" : "0"},700);

	getSVG("assets/icons/facebook.svg",container+" .social a.facebook");
	getSVG("assets/icons/twitter.svg",container+" .social a.twitter");
}
function large_cards( href ){
	$("main").html("<div id='large_cards_container'></div>");
	
	var heading = (href.split("/")[1]).replace(/%20/g, " ");
	
	var heading = heading.toLowerCase().replace(/\b[a-z]/g, function( result ) { //can be made to a function
	    return result.toUpperCase();
	});
	
	title("div#large_cards_container",heading,"alternate");
	
	$.each(JSONobj[model[0]][0],function( key, value ){
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
+				"<div class='fade'><a href=# class='more'>Expand</a></div>"
+			"</div>"
+		"</div>"
+	"</div>").children(".container").fadeIn();

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
function render_home(url){
	$("main").append("<div id='slideshow'><ul id='controls'></ul><ul id='slides'></ul><div>");
	$("main").append("<div id='carousel_section' class='carousel_packages'><div id='carousel'></div><ul id='controls'><li><a href=# data-func='next'></a></li><li><a href=# data-func='prev'></a></li></ul><div>");
	$("main").append("<div id='customer_quote'><ul id='controls'></ul><div class='quote_container'></div></div>");
	
	getSVG("assets/icons/arrow.svg","div#carousel_section #controls a");
	
	var home_slideshow = new slideshow("div#slideshow", JSONobj["Slideshow"][0], 9000, 500);
	var featured_packages = new carousel_obj( "div#carousel_section", JSONobj["Packages"][0], 4, "State", "Featured", "packages" );
	
	$.each(JSONobj['Quotes'][0],function(key,value){
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
		'<div class="heading_strip" style="margin-top:0">'
	+	'<div class="heading_wrapper">'
	+	'<h3 class="heading">Featured <b>Packages</b></h3>'
	+	'</div>'
	+	'</div>'
	);
}
function basic_cards(){
	$("main").html("<div class='basic_cards_container'></div>");
	$.each(JSONobj[model[0]][0],function( key, value ){
		title("div.basic_cards_container", value.Title, "alternate");
		render_basic_cards(value.Text, "emphasis_small");
	});
}

function render_basic_cards(content,type){
	$("div.basic_cards_container").append('<div class="basic_cards '+ type +'">'+ content +'</div>');
}
function getBaseURL() {
    var url = location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));


    if (baseURL.indexOf('http://localhost') != -1) {
        var url = location.href;
        var pathname = location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        return baseURL + "/";
    }

}

function getSVG(location,target){
	$.get(baseURL+location,function(data){
		$(target).html(data);
	},"text");
}

function title(below,title,type){
	$(below).before('<div class="heading_strip '+ type +'">'
+	'<div class="heading_wrapper">'
+	'<h3 class="heading">'+ title +'</b></h3>'
+	'</div>'
+	'</div>');
}
function mobile_menu(){
	$(document).on("click","a#menu",function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active").children("svg").attr("class","");
			 $("header#small div#header_right, header#small nav#left").css({"margin-left":"100%"});
		}else{
			$(this).addClass("active").children("svg").attr("class","active");
			$("header#small div#header_right, header#small nav#left").css({"margin-left":"0"});
		}
	});
	
	if(window.innerWidth < 500){
		$(document).on("click", "nav a", function(){
			$("a#menu").removeClass("active").children("svg").attr("class","");
			$("header#small div#header_right, header#small nav#left").css({"margin-left":"100%"});
		});
	}
}

function nav_click(){
	$(document).on("click","nav a",function(e){
		$("main").children().fadeOut(function(){
			$(this).remove();
		});
		
		var href = $(this).attr("href");
		var model = href.toLowerCase().replace(/\b[a-z]/g, function(result) { 
		    return result.toUpperCase();
		});
		
		var url = $(this).prop("href");
		window.history.pushState("","Title",baseURL+href);
		
		var req = $(this).attr("data-req");
		
		handle(req_models[req],url,href,req,null);
		
		e.preventDefault();
	});
}

function small_cards_click(){
	$(document).on("click","div#small_cards_container a",function(e){
		$("main").children().fadeOut(function(){
			$(this).remove();
		});
		
		var href = $(this).attr("href");
		
		var url = $(this).prop("href");
		window.history.pushState("","Title",baseURL+href);
		
		var req = $(this).attr("data-req");
		
		object_ID = $(this).attr("data-id");
		
		handle(req_models[req],url,href,req,object_ID);
		
		e.preventDefault();
	});
}

function quotes_control(){
	$(document).on("click","div#customer_quote #controls a",function(e){
		var active=$("div#customer_quote .quote_container .active");
		var active_id=$(this).attr("data-id");
		
		$(active).animate({"opacity":0},150).removeClass("active");
		$("div#customer_quote div[data-id=" + active_id + "]").delay(200).animate({"opacity":1},150).addClass("active");
		$("div#customer_quote #controls a.active").css({"background-color":"#bfc0c2"}).removeClass("active");
		$("div#customer_quote #controls a[data-id=" + active_id + "]").css({"background-color":"#30bec1"}).addClass("active");
		
		e.preventDefault();
	});
}

function cards_expand(){
	$(document).on("click","div#large_cards_container a,div#rooms_cards_container a,div#includes_cards_container a",function(e){
		if($(this).attr("class")==="more"){
			$(this).parent().parent().closest("div").css({"height":"auto"},200);
			$(this).html("Minimize").attr("class","less");
			
			$(this).parent().css({"height":"40px"});
		}else{
			$(this).parent().parent().closest("div").css({"height":"200px"},200);
			$(this).html("Expand").attr("class","more");
			
			$(this).parent().css({"height":"70px"});
		}
		e.preventDefault();
	});
}
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