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
	
	// if(window.innerWidth>=984){
		// $(window).scroll(function(){
			// if($(window).scrollTop()>300){
				// $("header#small").slideDown(200);
			// }else if($(window).scrollTop()<=300){
				// $("header#small").slideUp("fast");
			// }
		// });
	// }
	
	$(document).on("click","nav#right a",function(e){
		$("main").children().fadeOut(function(){$(this).remove();});
		
		var href = $(this).attr("href");
		var model = href.toLowerCase().replace(/\b[a-z]/g, function(result) { //can be made to a function
		    return result.toUpperCase();
		});
		
		var url = $(this).prop("href");
		window.history.pushState("","Title",url);
		
		basicPage(model,url);
		
		e.preventDefault();
	});
	
	$(document).on("click","nav#left a",function(e){
		$("main").children().fadeOut(function(){$(this).remove();});
		
		var href = $(this).attr("href");
		var model = href.toLowerCase().replace(/\b[a-z]/g, function(result) { //can be made to a function
		    return result.toUpperCase();
		});
		
		var url = $(this).prop("href");
		window.history.pushState("","Title",url);
		
		cardsPage(model,url,"Duration","duration");
		
		e.preventDefault();
	});
	
	$(document).on("click","div#featuredPackages_section #controls a",function(e){
		var page=$(this).attr("data-page");
		packagesPaginate("Featured",page,"4");
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
	
	basicJSON = {};
	cardsJSON = {};
	slideshow(9000,500);
	
});

function home(){
	if(typeof homeJSON !== "undefined" && homeJSON.length){
		homePageHandler();
	}else{
		$.getJSON("JSONroute.php",{url:url},function(data){
			homeJSON=data;
			homePageHandler();
		});
	}
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

function packagesPaginate(state,page,rows){
	if(typeof packagesJSON !== "undefined" && packagesJSON.length){
		packagesPaginateHandler(state,page,rows);
	}else{
		$.getJSON("queries.php",{model:"Packages",method:"getPackages"},function(data){
			packagesJSON=data;
			packagesPaginateHandler(state,page,rows);
		});
	}
}
function packagesPaginateHandler(state,page,rows){
	start_key=((page-1)*rows);
	end_key=start_key+rows-1;
	
	$("div#featured_packages .container").fadeOut().remove();
	$.each(packagesJSON,function(key,value){
		if(value.State == state && key>=start_key && key<=end_key){
			cards("featured_packages",value.Image,value.Name,value.Price,value.Overview,value.Duration,"duration");
		}
	});
}

function basicPage(model,url){
	if(typeof basicJSON[model] !== "undefined" && basicJSON[model].length){
		basicPageHandler(model);
	}else{
		$.getJSON("JSONroute.php",{url:url},function(data){
			basicJSON[model]=data;
			basicPageHandler(model);
		});
	}
}

function basicPageHandler(model){	
	$.each(basicJSON[model],function(key,value){
		var content = value.Text;
		
		title(value.Title,"alternate");
		basicContent(content,"emphasis_small");
	});
}

function cardsPage(model,url,variable,icon){
	if(typeof cardsJSON[model] !== "undefined" && cardsJSON[model].length){
		cardsPageHandler(model,variable,icon);
	}else{
		$.getJSON("JSONroute.php",{url:url},function(data){
			cardsJSON[model]=data;
			cardsPageHandler(model,variable,icon);
		});
	}
}

function cardsPageHandler(model,variable,icon){
	$("main").html("<div id='cards_container'></div>");
	
	title(model,"alternate");
	$.each(cardsJSON[model],function(key,value){
		cards("cards_container",value.Image,value.Name,value.Price,value.Overview,value.variable,icon);
	});
}

function title(title,type){
$("main").prepend('<div class="heading_strip '+ type +'">'
+	'<div class="heading_wrapper">'
+	'<h3 class="heading">'+ title +'</b></h3>'
+	'</div>'
+	'</div>');
}

function basicContent(content,type){
$("main").append('<div class="gutter_space '+ type +'">'
+	'<div class="white_contain">'+ content +'</div>'
+	'</div>');
}

function cards(container,image,name,price,overview,variable,icon){
$("div#"+container).append("<div class='container'>"
+	"<div>"
+	"<a href=#>"
+	"<div>"
+	"<img src='"+ image +"'/>"
+	"<span class='emphasis_small'>From <b>USD "+ price +"</b></span>"
+	"</div>"
+	"<div>"
+	"<span class='emphasis_large'>"+ name +"</span>"
+	"<p class='summary'>"+ overview +"</p>"
+	"</div>"
+	"</a>"
+	"<div>"
+	"<img src='assets/icons/"+ icon +".svg' height='15'/><span class='smallest'>"+ variable +" days</span>"
+	"<div>"
+	"<a href=#><?php include('assets/icons/twitter.svg'); ?></a>"
+	"<a href=#><?php include('assets/icons/facebook.svg'); ?></a>"
+	"</div>"
+	"</div>"
+	"</div>"
+	"</div>").children(".container").fadeIn();
}
