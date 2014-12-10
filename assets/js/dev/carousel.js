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