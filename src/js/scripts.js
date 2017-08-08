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
		'utm_source': '#source',
		'utm_medium': '#medium', 
		'utm_campaign': '#campaign',
		'utm_term': '#term',
		'utm_content': '#content'
	};

	// load form values
	$.each(urlVars,function(key,val){
		if($.getUrlVar(key)){
			$(val).val($.getUrlVar(key));
		}
	});

	//header social share hover states
	$('header .social-list a').hover(function() {
		var $thisImg = $(this).find('img');
		$thisImg.attr('src',$thisImg.attr('src').replace('.png','-hover.png'));
	}, function() {
		var $thisImg = $(this).find('img');
		$thisImg.attr('src',$thisImg.attr('src').replace('-hover.png','.png'));
	});

	$('#state').selectmenu({
	  width: '100%'
	});

	$( "#state" ).on( "selectmenuselect", function( event, ui ) {
		if(ui.item.value != ''){
			console.log('hide it');
			$('label[for="state-button"]').hide();
		} else {
			$('label[for="state-button"]').hide();
		}
	} );


	// track initial page view
	dataLayer.push({
	  'gaVirtualPageURL': '/start',
	  'event': 'gaVirtualPageview'
	});
	console.log('triggering event: /start');





	
});