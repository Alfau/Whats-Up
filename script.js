$(document).ready(function(){
	$(document).on("click","a#menu",function(){
		if($(this).hasClass("active")){
			$(this).children().attr("class","");
			load_remove_individually("remove");
			$(this).removeClass("active");
		}else{
			$(this).children("svg").attr("class","active");
			load_remove_individually('load');
			$(this).addClass("active");
		}
	});
	
	// $(window).scroll(function(){
		// if($(window).scrollTop()>300){
			// $("header#small").slideDown(200);
		// }else if($(window).scrollTop()<=300){
			// $("header#small").slideUp("fast");
		// }
	// });
	
	slideshow(9000,700);
});

function load_remove_individually(request){
	var list="div#header_bottom li";
	var count=$(list).length;
	var interval=150;
	
	if(request=="load"){
		var increment=1;
		$(list+":eq(0)").stop().slideDown(interval);
		var Interval=setInterval(function(){
			if(increment!=count){
				$(list+":eq("+increment+")").stop().slideDown(interval);
				increment++;
			}else if(increment>=count){
				clearInterval(Interval);
			}
		},interval);
	}else if(request=="remove"){
		var increment=count-1;
		$(list+":eq("+count+")").stop().slideUp(interval);
		var Interval=setInterval(function(){
			if(increment<=count){
				$(list+":eq("+increment+")").stop().slideUp(interval);
				increment--;
			}else if(increment<=0){
				clearInterval(Interval);
			}
		},interval);
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
		
		$(active).animate({"opacity":0},speed).removeClass("active").children(".text").animate({"opacity":0,"font-size":"1em"},speed);
		$("div#slideshow li[data-id=" + active_id + "]").animate({"opacity":1},speed).addClass("active").children(".text").animate({"opacity":1,"font-size":"2em"},speed);
		$(control_active).css({"background-color":"#fff"}).removeClass("active");
		$("div#slideshow #controls a[data-id=" + active_id + "]").css({"background-color":"#30bec1"}).addClass("active");
	}
}
;