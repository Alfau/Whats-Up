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