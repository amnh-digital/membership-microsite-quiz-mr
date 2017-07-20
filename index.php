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
<div id="screen"></div>


<header>
	<div class="logo"><a href=""><img src="/dist/img/logo.png" alt="American Museum of Natural History"/></a></div>
	<div class="site-title"><h1>Quiz: When In The World</h1></div>
	<div class="social">
		<ul>
			<li><a href=""><img src="/dist/img/share-fb.png"/></a></li>
			<li><a href=""><img src="/dist/img/share-tw.png"/></a></li>
			<li><a href=""><img src="/dist/img/share-tum.png"/></a></li>
			<li><a href=""><img src="/dist/img/share-em.png"/></a></li>
		</ul>
	</div>
</header>
<!-- /header -->


<div id="form">
	<h3>Wait!</h3>
	<p><strong>Before we go on, please tell use where to send your decal!</strong></p>

	<div class="form-wrap">
		<label for="fn" class="required">First name</label>
		<input type="text" name="fn" id="fn">
	</div>

	<div class="form-wrap">
		<label for="ln" class="required">Last name</label>
		<input type="text" name="ln" id="ln">
	</div>

	<div class="form-wrap">
		<label for="em" class="required">Email</label>
		<input type="email" name="em" id="em">
	</div>

	<div class="form-wrap">
		<label for="address">Street Address</label>
		<input type="text" name="address" id="address">
	</div>

	<div class="form-wrap">
		<label for="city">City</label>
		<input type="text" name="city" id="city">
	</div>

	<div class="form-wrap form-state">
		<label for="state">State</label>
		<select id="state" name="state">
			<option>sdf</option>
		</select>
	</div>

	<div class="form-wrap form-zip">
		<label for="zip">Zip</label>
		<input type="text" name="zip" id="zip">
	</div>

	<div class="form-wrap form-submit">
		<input type="button" id="submit" value="Enter">
		<input type="hidden" name="submitedYear" id="submittedYear"/>
	</div>

	<p class="footnote">We'll send you fascinating new discoveries, special offers, and sneak peeks at upcoming exhibitions.</p>
	<p class="footnote">And if you don’t love seeing cool content, you can unsubscribe at any time.</p>
</div>
<!-- #form -->

<!-- wrapper -->
<div class="wrapper"></div>
<!-- /.wrapper -->

<!-- tooltip -->
<div id="tooltip">
	<span class="first">Scroll timeline</span><br />
	<span class="grey">and select time period below</span>
</div>
<!-- /#tooltip -->

<!-- timeline elements -->
<div id="timeline-spacer"></div>
<div id="timeline" class="dragscroll"></div>
<!-- /timeline elements -->

<div id="splash-screen">
	<div id="intro">
		<img src="/dist/img/logo-white.png"/>
		<h1>When In The World Quiz</h1>
		<p>Our history is vast. From the formation of our universe to the growth and evolution of life to the development of human cultures as we know them – it's an extensive journey through time and space.</p>

		<p>We celebrate and explore all of that history at the American Museum of Natural History. We find that it's especially tricky to grasp the immense scales involved – in the simplest terms, what happened when.</p>

		<p>Now's your chance to test your knowledge. Take the When in the World quiz and see if you can pinpoint key moments on the timeline, from mammoths to mummies. Take the quiz before September 9, and we’ll send you a free Museum decal so you can show off your smarts!</p>

		<div id="jedediah">
			<div class="left"><span>the</span></div>
			<div class="right"><span>Take Quiz</span></div>
		</div>

	</div>
</div>






<script>
	var questions = {
		'questions':[
			{
				'text': 'You gotta start somewhere (or somewhen): when did our solar system form?',
				'answerText': '<p>Our solar system began forming from a wispy cloud of gas and dust about 4.6 billion years ago. Gravity compressed the center of this flat spinning disk until nuclear fusion sparked our Sun, with enough leftover material for planets, moons, asteroids, and comets. And while 4.6 billion years ago seems like a long time, think about this: our galaxy had already been around for over 8.5 billion years before the Sun came into existence.</p>',
				'answer': '-4.6',
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
				'answerText': '',
				'answer': 'f',
				'min': 1850,
				'max': 1899,
				'minorScale': 1,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 10,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': '',
				'image': 'stars.jpg',
				'timelineMinWidth': 1600
			}/*,
			{
				'text': 'When did the Aztec civilization exist in central and southern Mexico?',
				'answerText': '',
				'min': 1000,
				'max': 1800,
				'minorScale': 20,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 200,
				'majorLabelRoundScale': 100,
				'majorLabelOffset': -1,
				'majorGridLabel': 'th Century',
				'image': 'lions.jpg'
			}*/
		]
	};

	$(document).ready(function(){
		$('#jedediah').click(function(){
			timeline.init({data: questions,splash: '#splash-screen'});
		});
	});

	timeline.init({data: questions,splash: '#splash-screen'});


</script>
</body>
</html>