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
	
	$(window).scroll(function(){
		if($(window).scrollTop()>300){
			$("header#small").slideDown(100);
		}else if($(window).scrollTop()<=300){
			$("header#small").slideUp("fast");
		}
	});
	
	setInterval(function(){
		var active=$("div#slideshow li.active");
		var control_active=$("div#slideshow #controls a.active");
		var active_id=$(active).attr("data-id");
		
		$(active).is(":last-child") ? active_id=1 : active_id++;
		
		$(active).animate({"opacity":0},700).removeClass("active").children(".text").animate({"opacity":0,"font-size":"1em"},700);
		$("div#slideshow li[data-id="+active_id+"]").animate({"opacity":1},700).addClass("active").children(".text").animate({"opacity":1,"font-size":"2em"},700);
		$(control_active).css({"background-color":"#fff"}).removeClass("active");
		$("div#slideshow #controls a[data-id="+active_id+"]").css({"background-color":"#30bec1"}).addClass("active");		
	},9000);
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
