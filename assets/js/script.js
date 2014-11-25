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
	
	
	$(document).on("click","div#featuredPackages_section #controls a",function(e){
		var page=$(this).attr("data-page");
		packagesPaginate("Featured",page);
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
	
	slideshow(9000,500);
	//packagesPaginate("Featured","1");
});


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

function packagesPaginate(state,page){
	if(typeof packagesJSON !== "undefined" && packagesJSON.length){
		packagesPaginateHandler(state,page);
	}else{
		$.getJSON("/packages",function(data){
			packagesJSON=data;
			packagesPaginateHandler(state,page);
		});
	}
}
function packagesPaginateHandler(state,page){
	rows=4;
	start_key=((page-1)*rows);
	end_key=start_key+rows-1;
	$("div#featured_packages .container").fadeOut().remove();
	$.each(packagesJSON,function(key,value){
		if(value.State == state && key>=start_key && key<=end_key){
			$("div#featured_packages").append(
				"<div class='container'>"
				+	"<div>"
				+		"<a href=#>"
				+			"<div>"
				+				"<img src='"+ value.Image +"'/>"
				+				"<span class='emphasis_small'>From <b>USD "+ value.Price +"</b></span>"
				+			"</div>"
				+			"<div>"
				+				"<span class='emphasis_large'>"+ value.Name +"</span>"
				+				"<p class='summary'>"+ value.Overview +"</p>"
				+			"</div>"
				+		"</a>"
				+		"<div>"
				+		"<img src='assets/icons/duration.svg' height='15'/><span class='smallest'>"+ value.Duration +" days</span>"
				+			"<div>"
				+				"<a href=#><?php include('assets/icons/twitter.svg'); ?></a>"
				+				"<a href=#><?php include('assets/icons/facebook.svg'); ?></a>"
				+			"</div>"
				+		"</div>"
				+	"</div>"
				+"</div>"
			).children(".container").fadeIn();
		}
	});
}