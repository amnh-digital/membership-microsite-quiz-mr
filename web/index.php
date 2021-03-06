<?php 
require('../config.php');

$app['session']->clear();

?>
<!DOCTYPE html>
<html lang="en-US">
<head>   
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
	<meta name="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Content-language" content="en-US" />  
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="SHORTCUT ICON" href="/slideImages/favicon.ico">

	<title>American Museum of Natural History Quiz</title>

	<meta name="author" content="" />
	<meta name="copyright" content="" />
	<meta name="keywords" content="" />
	<meta name="description" content="">

	<meta property="og:title" content="When in the World?" />
	<meta name="og:description" content="Think you know what happened when? Take the American Museum of Natural History's new quiz, When in the World—and see if you can place mammoths, mummies, and more on the timeline. Special bonus: take the quiz today, and they’ll send you a free decal.">
	<meta property="og:image" content="https://whenintheworld.amnh.org/slideImages/AMNHquizfb.jpg" />
	<meta property="og:site_name" content="AMNH" />
	<meta property="og:type" content="non_profit" />
	<meta property="og:url" content="https://whenintheworld.amnh.org/" />
	<meta property="fb:app_id" content="1409773259334320" />

	<link rel="Home" href="/" title="amnh front page" />
	<link rel="Search" href="/content/advancedsearch" title="Search amnh" />
	<link rel="Copyright" href="/about-the-museum/copyright" title="Copyright"/>
	<link rel="Author" href="/about-the-museum" title="Author"/>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WZCFGBM');</script>
	<!-- End Google Tag Manager -->

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/dist/css/main.css" type="text/css">

	<script type="text/javascript" src="/dist/js/main.js" charset="utf-8"></script>
	<script src="https://cdn.optimizely.com/js/5768981649.js"></script>

	<script src="https://use.typekit.net/oqo1hqs.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZCFGBM"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="screen"></div>


<header>
	<div class="logo"><a href="http://www.amnh.org/?utm_medium=Referral&utm_source=whenintheworld.amnh.org&utm_campaign=WhenIntheWorldQuiz" id="gtm-header-logo-amnh"><img src="/dist/img/logo.png" alt="American Museum of Natural History"/></a></div>
	<div class="site-title"><h1>When In The World Quiz</h1></div>
	<div class="social">
		<ul class="social-list">
			<li><a href="https://www.facebook.com/sharer/sharer.php?u=https%3A//whenintheworld.amnh.org/%3Futm_medium%3Dsocial%26utm_source%3Dfbshare%26utm_campaign%3DWhenIntheWorldQuiz" id="gtm-header-icon-fb" target="new"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			<li><a href="https://twitter.com/intent/tweet?text=Take+the+When+in+the+World%3F+quiz+from+&#64;AMNH+and+test+your+knowledge.+Try+it+now+and+get+a+free+decal%3A+http%3A//bit.ly/2u90yrj" id="gtm-header-icon-tw" target="new"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			<li><a href="http://tumblr.com/widgets/share/tool?canonicalUrl=https://whenintheworld.amnh.org" id="gtm-header-icon-tum" target="new"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
		</ul>
	</div>
</header>
<!-- /header -->


<div id="form"><form>
	<h3>Wait!</h3>
	<p><strong>Before we go on, please tell use where to send your decal!</strong></p>

	<div class="form-wrap form-half-left">
		<input type="text" name="fn" id="fn">
		<label for="fn" class="required placeholder">First name</label>
	</div>

	<div class="form-wrap form-half-right">
		<input type="text" name="ln" id="ln">
		<label for="ln" class="required placeholder">Last name</label>
	</div>

	<div class="form-wrap">
		<input type="email" name="em" id="em">
		<label for="em" class="required placeholder">Email</label>
	</div>

	<div class="form-wrap form-check">
		<input id="optin" type="checkbox" name="optin" value="y">
		<label for="optin">Yes, send me a free Museum decal.</label>
	</div>

	<div class="form-wrap">
		<input type="text" name="address" id="address">
		<label for="address" class="placeholder">Street Address</label>
	</div>

	<div class="form-wrap">
		<input type="text" name="city" id="city">
		<label for="city" class="placeholder">City</label>
	</div>

	<div class="form-wrap form-half-left">
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
		<label for="state" class="placeholder">State</label>
	</div>

	<div class="form-wrap form-half-right">
		<input type="text" name="zip" id="zip">
		<label for="zip" class="placeholder">Zip</label>
	</div>

	

	<div class="form-wrap error-wrapper">
		<span>Oops, something went wrong on the form! Please fill in any missing information above.</span>
	</div>

	<div class="form-wrap form-submit">
		<input type="button" id="submit" value="Enter">
		<input type="hidden" name="submittedYear" id="submittedYear"/>
		<input type="hidden" name="source" id="source" value="Organic"/>
		<input type="hidden" name="medium" id="medium" value=""/>
		<input type="hidden" name="campaign" id="campaign" value=""/>
		<input type="hidden" name="term" id="term" value=""/>
		<input type="hidden" name="content" id="content" value=""/>
	</div>

	<p class="footnote">** Free decal giveaway is available for United States residents only. </p>
	<p class="footnote">We'll send you fascinating new discoveries, special offers, and sneak peeks at upcoming exhibitions.</p>
	<p class="footnote">And if you don't love seeing cool content, you can unsubscribe at any time.</p>
</form></div>
<!-- #form -->

<!-- wrapper -->
<div class="wrapper"></div>
<!-- /.wrapper -->

<!-- tooltip -->
<div id="tooltip">
	<div class="first">Select a date on the timeline</div>
	<div class="second">
		<div class="arrow arrow-left"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></div>
		<div class="grey">Click the arrows to scroll</div>
		<div class="arrow arrow-right"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></div>
	</div>
</div>
<!-- /#tooltip -->

<!-- timeline elements -->
<div id="timeline-spacer"></div>


<div id="timelineHolder">
	<div id="timelineOuter">
		<div id="timelineInner" class="dragscroll">
			<div id="timeline"></div>
		</div>
	</div>
</div>




<!-- /timeline elements -->

<div class="splash" id="splash-screen">
	<div id="intro">
		<img src="/dist/img/logo-white.png"/>
		<h1>When In The World? Quiz</h1>
		<p>We celebrate and explore history here at the Museum, and one of the trickiest parts to grasp is the immense scale involved&#8212;in the simplest terms, what happened when.</p>
 
		<p class="desktop">Now's your chance to test your knowledge. Take the <em>When in the World</em> quiz and see if you can pinpoint key moments on the timeline, from mammoths to mummies. <strong>We're sending everyone who takes the quiz before September 9 a free Museum decal&#8212;so go ahead and start your journey through time!</strong></p>

		<div id="introBottomWrap">
			<fieldset id="decalWrapper">
				<legend align="center">Get A Free Decal</legend>
		
					<img src="/dist/img/amnhQuizDecal.png"/>
			
			</fieldset>

			<div id="jedediah">
				<div class="left"><span>the</span></div>
				<div class="right"><span>Take Quiz</span></div>
			</div>
		</div>
	</div>
</div>

<div class="splash" id="confirmation-screen">
	<div id="thanks">
		<img src="/dist/img/logo-white.png" class="desktop"/>

		<h2 id="resultScoreContainer">You did better than <span id="resultScore">XX%</span> of people who took this quiz!</h2>

		<p>Thanks for exploring some of the key moments in the 4.6 billion-year story contained within the American Museum of Natural History. <span class="desktop">From our planet's earliest moments to the scientific breakthroughs happening today, this vast history helps us know more about who we are and what lies ahead.</span></p>
 
		<p><span class="optinLanguage">Your Museum decal will be on its way to you soon. </span>Now, take a moment to help us do what we do best: share fascinating facts far and wide! Share the When in the World quiz on <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A//whenintheworld.amnh.org/%3Futm_medium%3Dsocial%26utm_source%3Dfbshare%26utm_campaign%3DWhenIntheWorldQuiz" id="gtm-ty-link-fb" target="new">Facebook</a> and <a href="https://twitter.com/intent/tweet?text=Take+the+When+in+the+World%3F+quiz+from+&#64;AMNH+and+test+your+knowledge.+Try+it+now+and+get+a+free+decal%3A+http%3A//bit.ly/2u90yrj" id="gtm-ty-link-tw" target="new">Twitter</a>, and challenge your friends to put their knowledge to the test.</p>

		<p class="desktop">There is so much more to discover at the Museum, and Members get to explore our halls like no one else. Membership will give you unlimited access to the Museum's collections, along with tickets to special exhibitions and other incredible benefits.</p>

		<p class="desktop"><a href="http://www.amnh.org/join-support/membership?utm_medium=Referral&utm_source=whenintheworld.amnh.org&utm_campaign=WhenIntheWorldQuiz" id="gtm-ty-link-membership" target="new">Click here to learn more and start or renew your membership!</a></p>

		<p class="smaller"><a href="https://www.amnh.org/apiuser/register?utm_medium=Referral&utm_source=whenintheworld.amnh.org&utm_campaign=WhenIntheWorldQuiz" id="gtm-ty-link-profile" target="new">Click here</a> to finish creating your profile on AMNH.org to make sure you're in the know about all the events and news that's important to you.</p>

		<ul class="social-list">
			<li><a href="https://www.facebook.com/sharer/sharer.php?u=https%3A//whenintheworld.amnh.org/%3Futm_medium%3Dsocial%26utm_source%3Dfbshare%26utm_campaign%3DWhenIntheWorldQuiz" id="gtm-ty-icon-fb" target="new"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			<li><a href="https://twitter.com/intent/tweet?text=Take+the+When+in+the+World%3F+quiz+from+&#64;AMNH+and+test+your+knowledge.+Try+it+now+and+get+a+free+decal%3A+http%3A//bit.ly/2u90yrj" id="gtm-ty-icon-tw" target="new"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			<li><a href="http://tumblr.com/widgets/share/tool?canonicalUrl=https://whenintheworld.amnh.org" id="gtm-ty-icon-tum" target="new"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
		</ul>
	</div>
</div>

<div id="imgLoader">
	<img src="/slideImages/amnhBuilding.jpg"/>
	<img src="/slideImages/apollo2.jpg"/>
	<img src="/slideImages/earth.jpg"/>
	<img src="/slideImages/easterIsland.jpg"/>
	<img src="/slideImages/inside.jpg"/>
	<img src="/slideImages/livingThings.jpg"/>
	<img src="/slideImages/mammoths.jpg"/>
	<img src="/slideImages/mummification.jpg"/>
	<img src="/slideImages/solarSystem.jpg"/>
	<img src="/slideImages/stars.jpg"/>
	<img src="/slideImages/titanosaur.jpg"/>
</div>

<script>
	var questions = {
		'questions':[
			{ // 1
				'text': 'You gotta start somewhere (or somewhen): when did our solar system form?',
				'answerText': '<p>Our solar system began forming from a wispy cloud of gas and dust about 4.6 billion years ago. Gravity compressed the center of this flat spinning disk until nuclear fusion sparked our Sun, with enough leftover material for planets, moons, asteroids, and comets. <span class="desktop">And while 4.6 billion years ago seems like a long time, think about this: our galaxy had already been around for over 8.5 billion years before the Sun came into existence.</span></p>',
				'min': 	-6,
				'max': -3.1,
				'minorScale': .1,
				'minorLabelRoundScale': 1,
				'majorGridPoint': 1,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Billion years ago',
				'image': 'solarSystem.jpg',
				'imagePosition': '50% 10%',
				'timelineMinWidth': 1800
			},
			{ // 2
				'text': 'The sad thing about the first appearance of life on a planet is that there\'s no one around to say "It\'s alive. It\'s ALIIIIIVE!!!" When did living things first begin to form on Earth?',
				'answerText': '<p>Your first ancestor (and your cat\'s, your houseplant\'s, your digestive microorganisms\' first ancestor) appeared about 3.5 billion years ago. Scientists are still working to determine exactly <em>how</em> life first emerged&#8212;but knowing <em>when</em> is a pretty good start.</p>',
				'min': -4,
				'max': -1.1,
				'minorScale': .1,
				'minorLabelRoundScale': 1,
				'majorGridPoint': 1,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Billion years ago',
				'image': 'livingThings.jpg',
				'imagePosition': '50% 10%',
				'timelineMinWidth': 1600
			},
			{ // 3
				'text': 'They say that breaking up is hard to do&#8212;but without it, our planet wouldn\'t be nearly as interesting. When did the supercontinent of Pangaea begin to break up into the separate continents we know today?',
				'answerText': '<p>Pangaea broke up about 200 million years ago during the early Jurassic Period, as the continental plates inched along their separate paths.<span class="desktop"> The evidence of plate tectonics is all around, from the puzzle-piece coastlines of Africa and South America to the similarity of fossil organisms on land now separated by vast oceans&#8212;but it wasn\'t until the 20th Century that scientists recognized this crucial part of our history.</span></p>',
				'min': -600,
				'max': -125,
				'minorScale': 25,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 100,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Million years ago',
				'image': 'earth.jpg',
				'imagePosition': '50% 20%',
				'timelineMinWidth': 1600
			},
			{ // 4
				'text': '<span class="desktop">When life began (3.5 billion years ago, remember?), organisms were simple and microscopic. Evolution often moves slowly, but eventually life got complicated&#8212;and <em>big</em>. </span>When did the Museum\'s 122-foot-long plant-eating sauropod, the Titanosaur, roam the Earth?',
				'answerText': '<p>Researchers have dated the Titanosaur to the early Cretaceous Period, about 140 million years ago. The Titanosaur was one of the largest land animals to ever stomp its way across the Earth. It also happens to be the longest animal ever displayed at the American Museum of Natural History<span class="desktop"> (though not the most massive&#8212;that distinction goes to the blue whale, a model of which hangs in the Museum\'s Milstein Hall of Ocean Life)</span>.</p>',
				'min': -500,
				'max': -10,
				'minorScale': 20,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 50,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' million years ago',
				'image': 'titanosaur.jpg',
				'imagePosition': '50% 10%',
				'timelineMinWidth': 1600
			},
			{ // 5
				'text': 'Not as large as the Titanosaur, but still a commanding, thundering presence&#8212;when did the first mammoths appear?',
				'answerText': '<p>Mammoths, like the ones on display at the Museum, are "only" about 4 million years old. That\'s quite recent compared with when titanosaurs lived, but fully 3,000,000,000 years since life first emerged. Evolution can move very slowly.</p>',
				'min': -20,
				'max': -1,
				'minorScale': 1,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 10,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' Million years ago',
				'image': 'mammoths.jpg',
				'imagePosition': '50% 30%',
				'timelineMinWidth': 1600
			},
			{ // 6
				'text': 'Ancient Egyptians may get all the attention (thanks, Hollywood), but they were not the only ones to wrap and preserve their dead. When did cultures in Peru begin the practice of mummification?',
				'answerText': '<p>Several cultures in what is now Peru began practicing mummification over 7,000 years ago, long before the Egyptians. <span class="desktop">This practice helped the living connect with the dead&#8212;in fact, some people kept mummies in their homes or brought them to festivals.</span></p><p><em><span class="desktop">Take in the fascinating history of ancient mummification&#8212;Egyptian and Peruvian&#8212;in the special Mummies exhibition at the LeFrak Gallery, open through January 2018.</span></em></p>',
				'min': -20,
				'max': -1,
				'minorScale': 1,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 5,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ',000 years ago',
				'image': 'mummification.jpg',
				'imagePosition': '50% 10%',
				'timelineMinWidth': 1600
			},
			{ // 7
				'text': 'You may not recognize the name of the Rapa Nui, but you know their handiwork. They are the ones who carved <em>moai</em> ancestor figures <span class="desktop">as towering stone statues </span>on what we know as Easter Island (also called Rapa Nui). When did these people first settle on this <span class="desktop">remote</span> volcanic island?',
				'answerText': '<p>The Rapa Nui first arrived on this remote Polynesian island around 300 CE. Located 2,300 miles from the coast of Chile, it was the most isolated inhabited island in the world. <span class="desktop">And the <em>moai</em>? They may seem like ancient history, but these unique monuments were carved between the 12th and 16th centuries.</span></p>',
				'min': 0,
				'max': 690,
				'minorScale': 25,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 100,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': ' CE',
				'image': 'easterIsland.jpg',
				'imagePosition': '50% 30%',
				'timelineMinWidth': 1600
			},
			{ // 8
				'text': 'Here\'s one that\'s a little close to home: When was the American Museum of Natural History founded?',
				'answerText': '<p>The Museum was founded in 1869 thanks to the efforts of Albert Smith Bickmore<span class="desktop">, a one-time student of Harvard zoologist Louis Agassiz,</span> and a group of influential New Yorkers<span class="desktop"> including Theodore Roosevelt, Sr., and J. Pierpont Morgan. The rest, as they say, is history</span>.</p><p><em>The American Museum of Natural History is open from 10 am to 5:45 pm 363 days a year (closed on Thanksgiving and Christmas)<span class="desktop">—we hope to see you around sometime soon</span>!</em></p>',
				'min': 1850,
				'max': 1889,
				'minorScale': 1,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 10,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': '',
				'image': 'amnhBuilding.jpg',
				'imagePosition': '50% 20%',
				'timelineMinWidth': 1600
			},
			{ // 9
				'text': 'Okay, here\'s our last question, and the only one that you might well remember experiencing if you are of a certain age: when did the first person land on the Moon?',
				'answerText': '<p>That giant leap for mankind occurred on July 20, 1969, during the Apollo 11 mission&#8212;100 years after the founding of the Museum. It is a stirring reminder of the discoveries still to be made and frontiers still to be explored, and of the hunger for knowledge that drives everything we do at the Museum.</p>',
				'min': 1950,
				'max': 1979,
				'minorScale': 1,
				'minorLabelRoundScale': 0,
				'majorGridPoint': 10,
				'majorLabelRoundScale': 1,
				'majorLabelOffset': 0,
				'majorGridLabel': '',
				'image': 'apollo2.jpg',
				'imagePosition': '50% 15%',
				'timelineMinWidth': 1600
			}

			/*
			minorScale: amt between each minor tick mark

			*/
		]
	};

	timelineObj = {};
	timelineObj.data = questions;
	if($.getUrlVar('testing') && $.getUrlVar('testing') == 'true'){
		timelineObj.testing = true;
	}

	console.log(timelineObj);

	$(document).ready(function(){
		$('#jedediah').click(function(){
			timeline.init(timelineObj);
		});
	});

	//timeline.init({data: questions});


</script>
</body>
</html>