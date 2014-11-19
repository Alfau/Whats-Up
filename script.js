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
			$("header#small").slideDown(300);
			$("header#large").slideUp();
		}else if($(window).scrollTop()<=120){
			$("header#small").slideUp(function(){
				$("header#large").slideDown(300);
			});
		}
	});
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
