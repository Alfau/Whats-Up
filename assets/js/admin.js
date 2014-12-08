$(function() {
	$(document).on("click", ".delete", function(e) {
		var destroy = confirm("Are you sure you want to delete this entry?");

		if (destroy === false) {
			e.preventDefault();
		}
	});
});
