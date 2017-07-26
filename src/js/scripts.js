$.extend({
	getUrlVars: function(){
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++){
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	},
	getUrlVar: function(name){
		return $.getUrlVars()[name];
	}
});

$(document).ready(function(){
	var urlVars = {
		'fn':'#fn',
		'ln':'#ln',
		'em': '#em',
		'source': '#source'
	};

	$.each(urlVars,function(key,val){
		if($.getUrlVar(key)){
			$(val).val($.getUrlVar(key));
		}
	});
});