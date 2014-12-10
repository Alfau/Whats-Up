function BBabasic_cards(){
	$("main").html("<div class='basic_cards_container'></div>");
	$.each(JSONobj[model[0]][0],function( key, value ){
		title("div.basic_cards_container", value.Title, "alternate");
		render_basic_cards(value.Text, "emphasis_small");
	});
}

function render_basic_cards(content,type){
	$("div.basic_cards_container").append('<div class="basic_cards '+ type +'">'+ content +'</div>');
}