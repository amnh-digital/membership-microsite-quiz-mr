<?php 
require('../config.php');
?>
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
		<ul class="social-list">
			<li><a href=""><img src="/dist/img/share-fb.png"/></a></li>
			<li><a href=""><img src="/dist/img/share-tw.png"/></a></li>
			<li><a href=""><img src="/dist/img/share-tum.png"/></a></li>
			<li><a href=""><img src="/dist/img/share-em.png"/></a></li>
		</ul>
	</div>
</header>
<!-- /header -->


<div id="form"><form>
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
			<option value=""></option>
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="DC">District Of Columbia</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MI">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="PR">Puerto Rico</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>
			<option value="WA">Washington</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>
		</select>
	</div>

	<div class="form-wrap form-zip">
		<label for="zip">Zip</label>
		<input type="text" name="zip" id="zip">
	</div>

	<div class="form-wrap form-check">
		<input id="optin" type="checkbox" name="optin" value="y">
		<label for="optin">Yes, please send me the awesome gift.</label>
	</div>

	<div class="form-wrap error-wrapper">
		<span>Oops, something went wrong on the form! Please fill in any missing information below.</span>
	</div>

	<div class="form-wrap form-submit">
		<input type="button" id="submit" value="Enter">
		<input type="hidden" name="submittedYear" id="submittedYear"/>
		<input type="hidden" name="source" id="source"/>
	</div>

	<p class="footnote">We'll send you fascinating new discoveries, special offers, and sneak peeks at upcoming exhibitions.</p>
	<p class="footnote">And if you don't love seeing cool content, you can unsubscribe at any time.</p>
</form></div>
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

<div class="splash" id="splash-screen">
	<div id="intro">
		<img src="/dist/img/logo-white.png"/>
		<h1>When In The World Quiz</h1>
		<p>Our history is vast. It stretches back to stellar dust coalescing into planets… through imperceptibly small changes in geography that reshaped the face of the Earth over thousands of years... the slow evolutionary branching of all life… and yes, to human cultures developing, shifting, turning back out toward the stars.</p>

		<p>We celebrate and explore all of that history at the American Museum of Natural History. And one of the trickiest parts to grasp is the immense scale involved – in the simplest terms, what happened when.</p>

		<p>Now's your chance to test your knowledge. Take the <em>When in the World</em> quiz and see if you can pinpoint key moments on the timeline, from mummies to mammoths. <strong>Take the quiz before [DEADLINE] and we'll send you a free Museum decal so you can show off your smarts!</strong></p>

		<div id="jedediah">
			<div class="left"><span>the</span></div>
			<div class="right"><span>Take Quiz</span></div>
		</div>
	</div>
</div>

<div class="splash" id="confirmation-screen">
	<div id="thanks">
		<img src="/dist/img/logo-white.png"/>
		<h1>Thank Your for taking "When in the World quiz"</h1>

		<h2>You did better than <span>XX%</span> of people who took this quiz!</h2>

		<p>Thanks for exploring some of the key moments in the 4.6 billion-year story contained within the American Museum of Natural History. From our planet's earliest moments to the scientific breakthroughs happening today, this vast history helps us know more about who we are and what lies ahead.</p>
 
		<p>Your Museum decal will be on its way to you soon. Now, take a moment to help us do what we do best: share fascinating facts far and wide! Share the When in the World quiz on <a href="">Facebook</a> and <a href="">Twitter</a>, and challenge your friends to put their knowledge to the test.</p>

		<p>There is so much more to discover at the Museum, and Members get to explore our halls like no one else. Membership will give you unlimited access to the Museum's collections, along with tickets to special exhibitions and other incredible benefits.</p>

		<p><a href="http://www.amnh.org/join-support">Click here to learn more and start or renew your membership!</a></p>

		<p><a href="">Click here</a> to finish creating your profile on AMNH.org to make sure you're in the know about all the events and news that's important to you.

	
		<ul class="social-list">
			<li><a href=""><img src="/dist/img/share-fb.png"/></a></li>
			<li><a href=""><img src="/dist/img/share-tw.png"/></a></li>
			<li><a href=""><img src="/dist/img/share-tum.png"/></a></li>
			<li><a href=""><img src="/dist/img/share-em.png"/></a></li>
		</ul>
	</div>
</div>






<script>
	var questions = {
		'questions':[
			{
				'text': 'You gotta start somewhere (or somewhen): when did our solar system form?',
				'answerText': '<p>Our solar system began forming from a wispy cloud of gas and dust about 4.6 billion years ago. Gravity compressed the center of this flat spinning disk until nuclear fusion sparked our sun, with enough leftover material for planets, moons, asteroids, and comets. And while 4.6 billion years ago seems like a long time, think about this: our galaxy had already been around for over eight and a half billion years before the sun was a glimmer in the Milky Way\'s eye</p>',
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
				'text': 'The sad thing about the first appearance of life on a planet is that there was was no one around yet to say "It\'s alive. It\'s ALIIIIIVE!!!" When did living things first begin to form on Earth?',
				'answerText': '<p>Your first ancestor (and your cat\'s, your houseplant\'s, your digestive microorganisms\' first ancestor) appeared about 3.5 billion years ago. Scientists are still working to determine exactly how life first emerged – but knowing when is a pretty good start.</p>',
				'answer': -3.5,
				'min': -5,
				'max': -1.1,
				'minorScale': .1,
				'minorLabelRoundScale': 1,
				'majorGridPoint': 1,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Billion years ago',
				'image': 'stars.jpg',
				'timelineMinWidth': 1600
			},
			{
				'text': 'They say that breaking up is hard to do – but without it, our planet wouldn\'t be nearly as interesting. When did the supercontinent of Pangaea begin to break up into the separate continents we know today? ',
				'answerText': '<p>Pangaea broke up about 200 million years ago during the early Jurassic Period, as the continental plates inched along their separate paths. The evidence is all around, from the puzzle-piece coastlines of Africa and South America to the similarity of fossil organisms on land now separated by vast oceans – but it wasn\'t until the 20<sup>th</sup> Century that scientists recognized this crucial part of our history. </p>',
				'answer': -200,
				'min': -900,
				'max': -125,
				'minorScale': 25,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 100,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Million years ago',
				'image': 'stars.jpg',
				'timelineMinWidth': 1600
			},
			{
				'text': 'When life began (3.5 billion years ago, remember?), organisms were simple, microscopic things. Evolution moves slowly, but eventually life got complicated – and <em>big</em>. When did the 122-foot long plant-eating Titanosaur roam the Earth?',
				'answerText': '<p>Researchers have dated the Titanosaur to the early Cretaceous Period, about 140 million years ago. The Titanosaur was one of the largest land animals ever to stomp its way across the Earth. It also happens to be the longest animal ever displayed at the American Museum of Natural History (though not the most massive – that distinction goes to the blue whale in the Millstein Hall of Ocean Life).</p>',
				'answer': -140,
				'min': -500,
				'max': -10,
				'minorScale': 20,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 50,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' million years ago',
				'image': 'stars.jpg',
				'timelineMinWidth': 1600
			},
			{
				'text': 'Not as large as the Titanosaur, but still as warm and grandiose – when did the first mammoths appear?',
				'answerText': '<p>Mammoths, like the ones on display at the Museum, are "only" about 4 million years old. That\'s about 3% of the time since Titanosaurs lived, and fully 3,000,000,000 years since life first emerged. Like we said, evolution moves slowly.</p>',
				'answer': -4,
				'min': -100,
				'max': -2,
				'minorScale': 2,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 10,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Million years ago',
				'image': 'stars.jpg',
				'timelineMinWidth': 1600
			},
			{
				'text': 'She may be the most famous archeological discovery of all time, on a first-name basis with millions of people. But when did the hominid known as Lucy leave her footprints in African dust?',
				'answerText': '<p>Lucy, one of the most complete hominid skeletons ever discovered, lived around 3.2 million years ago. She was named after the Beatles song "Lucy in the Sky with Diamonds," which researchers played as they celebrated their find in 1974. Not a bad way to welcome a new (old) member of the extended human family.</p>',
				'answer': -3.2,
				'min': -5,
				'max': -.1,
				'minorScale': .1,
				'minorLabelRoundScale': 1,
				'majorGridPoint': 1,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Million years ago',
				'image': 'stars.jpg',
				'timelineMinWidth': 1600
			},
			{
				'text': 'Ancient Egyptians may get all the attention (thanks, Hollywood), but they were not the only ones to wrap and preserve their dead. When did cultures in Peru begin the practice of mummification?',
				'answerText': '<p>Several cultures in what is now Peru began practicing mummification 7,000 years ago, long before the Egyptians. This sacred practice helped the living connect with the dead – in fact, some people kept mummies in their homes or brought them to festivals.</p><p><em>Take in the fascinating history of ancient mummification– Egyptian and Peruvian – in the special Mummies exhibition at the LeFrak Gallery– open through January 2018.</em></p>',
				'answer': -7,
				'min': -40,
				'max': -1,
				'minorScale': 1,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 5,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' thousand years ago',
				'image': 'stars.jpg',
				'timelineMinWidth': 1600
			},
			{
				'text': 'You may not recognize the name of the Rapa Nui, but you know their handiwork: this is the culture that carved the Moai statues of Easter Island. When did the Rapa Nui first settle on Easter Island?<br /><br />(DD: this one needs some work... ignore timeline for now)',
				'answerText': '<p>The Rapa Nui first arrived on Easter Island around 300 CE – at 2,300 miles from the coast of Chile, it was the most isolated inhabited island in the world. And the Moai? They may seem like ancient history, but these unique monuments were carved between the 10th and 16th Centuries.</p>',
				'answer': -3.5,
				'min': -5,
				'max': -1.1,
				'minorScale': .1,
				'minorLabelRoundScale': 1,
				'majorGridPoint': 1,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Billion years ago',
				'image': 'stars.jpg',
				'timelineMinWidth': 1600
			},
			{
				'text': 'Here\'s one that\'s a little close to home: When was the American Museum of Natural History founded?',
				'answerText': '<p>The Museum was founded in 1869 thanks to the efforts of Albert Smith Bickmore, a one-time student of Harvard zoologist Louis Agassiz, and a group of influential New Yorkers including Theodore Roosevelt, Sr., and J. Pierpont Morgan. The rest, as they say, is history.</p><p><em>The American Museum of Natural History is open from 10 am to 5:45 pm 363 days a year (closed on Thanksgiving and Christmas) – we hope to see you around sometime soon! </em></p>',
				'answer': 1869,
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
			},
			{
				'text': 'Okay, here\'s our last question, and the only one that you might well remember experiencing if you are of a certain age: when did the first person land on the moon?',
				'answerText': '<p>That giant leap for mankind occurred on July 20, 1969 during the Apollo 11 mission – 100 years after the founding of the Museum. It is a stirring reminder of the discoveries still to be made and frontiers still to be explored, the hunger for knowledge that drives everything we do at the Museum.</p>',
				'answer': 1969,
				'min': 1920,
				'max': 1989,
				'minorScale': 1,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 10,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': '',
				'image': 'stars.jpg',
				'timelineMinWidth': 2200
			}

			/*
			minorScale: amt between each minor tick mark

			*/
		]
	};

	$(document).ready(function(){
		$('#jedediah').click(function(){
			timeline.init({data: questions});
		});

		body = $('body');
		var container = document.createElement('div');
		container.id = 'foo';
		container.innerHTML = 'content';
		$(container).insertBefore($('#widgetScript'));


	});

	//timeline.init({data: questions});


</script>
</body>
</html>