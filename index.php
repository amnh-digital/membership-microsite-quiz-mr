<!DOCTYPE html>
<html lang="en-US">
<head>   
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
	<meta name="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Content-language" content="en-US" />  
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="SHORTCUT ICON" href="/dist/img/favicon.ico">

	<title>American Museum of Natural History Quiz</title>

	<meta name="author" content="" />
	<meta name="copyright" content="" />
	<meta name="keywords" content="" />
	<meta name="description" content="">

	<meta property="og:title" content="American Museum of Natural History Quiz" />
	<meta name="og:description" content="There's so much to see and do at the American Museum of Natural History">
	<meta property="og:image" content="http://earthbulletin.amnh.org/extension/amnh/design/amnh_user/images/home-share.png" />
	<meta property="og:site_name" content="AMNH" />
	<meta property="og:type" content="non_profit" />
	<meta property="og:url" content="" />
	<meta property="fb:app_id" content="1409773259334320" />

	<link rel="Home" href="/" title="amnh front page" />
	<link rel="Search" href="/content/advancedsearch" title="Search amnh" />
	<link rel="Copyright" href="/about-the-museum/copyright" title="Copyright"/>
	<link rel="Author" href="/about-the-museum" title="Author"/>

	<link rel="stylesheet" href="/dist/css/main.css" type="text/css">
	<script type="text/javascript" src="/dist/js/main.js" charset="utf-8"></script>

	<script src="https://use.typekit.net/oqo1hqs.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

</head>
<body>

<header>
	<div class="logo"><a href=""><img src="/dist/img/logo.png" alt="American Museum of Natural History"/></a></div>
	<div class="site-title"><h1>Quiz: When In The World</h1></div>
	<div class="social">social</div>
</header>
<div class="wrapper"></div>

<div id="tooltip">Scroll timeline and select tiem period below</div>
<div id="timeline-spacer"></div>
<div id="timeline" class="dragscroll"></div>




<script>
	var questions = {
		'questions':[
			{
				'text': 'When did our solar system form?',
				'min': 	-8,
				'max': -2.1,
				'minorScale': .1,
				'minorLabelRoundScale': 1,
				'majorGridPoint': 1,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Billion years ago',
				'image': 'museum-outside.jpg',
				'timelineMinWidth': 1800
			},
			{
				'text': 'When was the American Museum of Natural History founded?',
				'min': 1850,
				'max': 1899,
				'minorScale': 1,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 10,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': '',
				'image': 'lions.jpg'
			},
			{
				'text': 'When did the Aztec civilization exist in central and southern Mexico?',
				'min': 1000,
				'max': 1800,
				'minorScale': 20,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 200,
				'majorLabelRoundScale': 100,
				'majorLabelOffset': -1,
				'majorGridLabel': 'th Century',
				'image': 'lions.jpg'
			}
		]
	};

	timeline.init({data: questions});


</script>
</body>
</html>