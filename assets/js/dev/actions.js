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