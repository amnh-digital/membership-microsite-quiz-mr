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

<style>
	/*#parent {
		width: 700px;
		overflow:hidden;
		height: 300px;
	}
	#wrap {
		position: relative;
		overflow: hidden;
		width: 100%;
		height: 100%;
	}
	#wrap2 {
	    position: absolute;
	    overflow: hidden;
	    width: 100%;
	    height: 100%;
	    isolation: isolate;
	}
    #wrap3 {
   	    position: absolute;
    	overflow: scroll;
    	z-index: 0;
	}
	#wrap4{
		float: left;
	    width: 700px;
	    height: 230px;
	}

	#inner {
		width: 2000px;
		    overflow-y: hidden;
		    height:230px;
	}*/

	.scrollable_y{
		width: 700px;
    	height: 200px;
    	overflow: hidden;
    	padding: 0px;
    	border: 1px solid white;
	}

	.river_wrap {
		height: 230px;
    width: 7500px;
    overflow-y: hidden;
	}




#fooWrap {
	bottom:0px;
	width: 100%;
	max-width: 100%;
	height: 200px;
	overflow:hidden;
	position: relative;
}
#inner {
	width: 100%;
	max-width: 100%;
	overflow: auto;
	position: absolute;
	right: -15px;
	 top: 0;
    bottom: -15px;
    left: 0;
}
#foo {
	width: 2000px;
	height: 100%;
	position: relative;

}
</style>




<div id="out">
<div id="fooWrap">
	<div id="inner" class="dragscroll">
		<div id="foo">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eros tellus, lobortis eu dictum maximus, tincidunt mattis libero. Vestibulum interdum gravida metus ornare condimentum. Nunc pulvinar nibh vitae enim tincidunt, sed viverra sapien tempus. Vestibulum luctus sed dui et convallis. Proin eros tortor, dignissim a tellus at, vestibulum posuere nulla. Donec eu turpis ex. Pellentesque a ipsum sagittis, varius sapien quis, facilisis magna. Curabitur aliquet enim sed ex bibendum feugiat.<br /><br />Curabitur varius viverra lacus non bibendum. Cras sed orci et sapien elementum sodales. Mauris non lacus eu enim ullamcorper sodales vehicula eu purus. Morbi fermentum neque consectetur odio pellentesque finibus. Donec venenatis faucibus orci eu auctor. Quisque scelerisque blandit quam eu pulvinar. Etiam convallis quam id justo consequat feugiat. Ut pulvinar aliquam auctor. Maecenas blandit orci nec ligula viverra, non mattis lectus vestibulum. Suspendisse pellentesque dignissim erat in accumsan. In tempus lacus quis tortor faucibus volutpat.<br /><br />Quisque quis pretium odio, vel lacinia libero. Cras feugiat gravida risus, dignissim varius massa. Proin molestie volutpat velit, quis venenatis metus scelerisque luctus. Etiam tincidunt pharetra est, id placerat leo. Pellentesque ultricies sed lacus quis bibendum. Praesent eget odio non urna euismod vehicula eu ac arcu. Nullam in dapibus tellus. Cras at nisi metus. In at diam gravida, dictum eros maximus, vestibulum risus. Donec eu condimentum nulla. Donec ut risus non nibh iaculis dapibus et et velit. Sed commodo rutrum sapien vel fringilla. Quisque pharetra lorem sit amet nunc viverra sagittis. In scelerisque ex eu eros malesuada tincidunt. Aenean sed lobortis dui. Sed fermentum massa vitae metus vehicula fermentum.
		</div>
	</div>
</div>
</div>



<!--
<div id="parent" class="dragscroll">
<div id="wrap">
<div id="wrap2">
<div id="wrap3">
<div id="wrap4">

<div id="inner">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eros tellus, lobortis eu dictum maximus, tincidunt mattis libero. Vestibulum interdum gravida metus ornare condimentum. Nunc pulvinar nibh vitae enim tincidunt, sed viverra sapien tempus. Vestibulum luctus sed dui et convallis. Proin eros tortor, dignissim a tellus at, vestibulum posuere nulla. Donec eu turpis ex. Pellentesque a ipsum sagittis, varius sapien quis, facilisis magna. Curabitur aliquet enim sed ex bibendum feugiat.<br /><br />Curabitur varius viverra lacus non bibendum. Cras sed orci et sapien elementum sodales. Mauris non lacus eu enim ullamcorper sodales vehicula eu purus. Morbi fermentum neque consectetur odio pellentesque finibus. Donec venenatis faucibus orci eu auctor. Quisque scelerisque blandit quam eu pulvinar. Etiam convallis quam id justo consequat feugiat. Ut pulvinar aliquam auctor. Maecenas blandit orci nec ligula viverra, non mattis lectus vestibulum. Suspendisse pellentesque dignissim erat in accumsan. In tempus lacus quis tortor faucibus volutpat.<br /><br />Quisque quis pretium odio, vel lacinia libero. Cras feugiat gravida risus, dignissim varius massa. Proin molestie volutpat velit, quis venenatis metus scelerisque luctus. Etiam tincidunt pharetra est, id placerat leo. Pellentesque ultricies sed lacus quis bibendum. Praesent eget odio non urna euismod vehicula eu ac arcu. Nullam in dapibus tellus. Cras at nisi metus. In at diam gravida, dictum eros maximus, vestibulum risus. Donec eu condimentum nulla. Donec ut risus non nibh iaculis dapibus et et velit. Sed commodo rutrum sapien vel fringilla. Quisque pharetra lorem sit amet nunc viverra sagittis. In scelerisque ex eu eros malesuada tincidunt. Aenean sed lobortis dui. Sed fermentum massa vitae metus vehicula fermentum.</div>
</div>
</div></div>
</div></div>



<div class="scrollable_y intence dragscroll river_frame" id="river_scroll" style="">
  <div style="position: relative; width: 100%; height: 100%;overflow:scroll;">
    <div style="position: absolute; width: 100%; height: 100%; isolation: isolate;">
      <div style="position: absolute; overflow: scroll; z-index: 0;">
            <div class="river_wrap">
            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eros tellus, lobortis eu dictum maximus, tincidunt mattis libero. Vestibulum interdum gravida metus ornare condimentum. Nunc pulvinar nibh vitae enim tincidunt, sed viverra sapien tempus. Vestibulum luctus sed dui et convallis. Proin eros tortor, dignissim a tellus at, vestibulum posuere nulla. Donec eu turpis ex. Pellentesque a ipsum sagittis, varius sapien quis, facilisis magna. Curabitur aliquet enim sed ex bibendum feugiat.<br /><br />Curabitur varius viverra lacus non bibendum. Cras sed orci et sapien elementum sodales. Mauris non lacus eu enim ullamcorper sodales vehicula eu purus. Morbi fermentum neque consectetur odio pellentesque finibus. Donec venenatis faucibus orci eu auctor. Quisque scelerisque blandit quam eu pulvinar. Etiam convallis quam id justo consequat feugiat. Ut pulvinar aliquam auctor. Maecenas blandit orci nec ligula viverra, non mattis lectus vestibulum. Suspendisse pellentesque dignissim erat in accumsan. In tempus lacus quis tortor faucibus volutpat.<br /><br />Quisque quis pretium odio, vel lacinia libero. Cras feugiat gravida risus, dignissim varius massa. Proin molestie volutpat velit, quis venenatis metus scelerisque luctus. Etiam tincidunt pharetra est, id placerat leo. Pellentesque ultricies sed lacus quis bibendum. Praesent eget odio non urna euismod vehicula eu ac arcu. Nullam in dapibus tellus. Cras at nisi metus. In at diam gravida, dictum eros maximus, vestibulum risus. Donec eu condimentum nulla. Donec ut risus non nibh iaculis dapibus et et velit. Sed commodo rutrum sapien vel fringilla. Quisque pharetra lorem sit amet nunc viverra sagittis. In scelerisque ex eu eros malesuada tincidunt. Aenean sed lobortis dui. Sed fermentum massa vitae metus vehicula fermentum.
            </div>
      </div>
    </div>
  </div>
</div>-->


<script>

	$(document).ready(function(){



	});


</script>
</body>
</html>