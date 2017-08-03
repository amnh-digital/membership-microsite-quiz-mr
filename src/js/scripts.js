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
	// define mapping for loading form values
	var urlVars = {
		'fn':'#fn',
		'ln':'#ln',
		'em': '#em',
		'source': '#source'
	};

	// load form values
	$.each(urlVars,function(key,val){
		if($.getUrlVar(key)){
			$(val).val($.getUrlVar(key));
		}
	});

	//header social share hover states
	$('.social-list a').hover(function() {
		var $thisImg = $(this).find('img');
		$thisImg.attr('src',$thisImg.attr('src').replace('.png','-hover.png'));
	}, function() {
		var $thisImg = $(this).find('img');
		$thisImg.attr('src',$thisImg.attr('src').replace('-hover.png','.png'));
	});


	// track initial page view
	dataLayer.push({
	  'gaVirtualPageURL': '/start',
	  'event': 'gaVirtualPageview'
	});
	console.log('triggering event: /start');
});