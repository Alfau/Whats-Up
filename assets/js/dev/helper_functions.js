function getBaseURL() {
    var url = location.href;  // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));


    if (baseURL.indexOf('http://localhost') != -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL + "/";
    }

}

function getSVG(location,target){
	$.get(baseURL+location,function(data){
		$(target).html(data);
	},"text");
}

function title(below,title,type){
	$(below).before('<div class="heading_strip '+ type +'">'
+	'<div class="heading_wrapper">'
+	'<h3 class="heading">'+ title +'</b></h3>'
+	'</div>'
+	'</div>');
}