<?php

require('../../config.php');

$message = '<br /><br />';

if(isset($_POST['submitted']) && $_POST['submitted'] == 'true'){
	$error = false;
	$clean = array();

	$u = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	if($u != ''){ $clean['username'] = $u; }
	else { $error = true; }

	$p = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
	if($p != ''){ $clean['password'] = $p; }
	else { $error = true; }

	if($error == false){
		
		$pwHash = hash('sha512', $clean['password'].$salt);

		$stmt = $app['pdo']->prepare('SELECT user_id,u FROM useradmin WHERE u = :u AND p = :p');
		$stmt->bindValue(':u', $clean['username']);
		$stmt->bindValue(':p', $pwHash);
		$stmt->execute();

		$admin = $stmt->fetch(PDO::FETCH_ASSOC);

		if($admin == false){
			$message = 'Your username and password are incorrect. Please try again.';
		} else { //validation passed

			if($app['session'] && $app['session']->get('user') != null){
				$sessionVals = $app['session']->get('user');
				$sessionVals['admin'] = true;
				$app['session']->set('user', $sessionVals);
			} else {
				$app['session']->set('user', array('admin' => true));
			}
			
			header('Location: admin.php');
		}

	} else {
		$message = 'Oops, something went wrong on the form! Please fill in any missing information below.';
	}


}

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

	<link rel="stylesheet" href="/dist/css/main.css" type="text/css">
	<script type="text/javascript" src="/dist/js/main.js" charset="utf-8"></script>

	<script src="https://use.typekit.net/oqo1hqs.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

</head>
<body class="admin login">

<header>
	<div class="logo"><a href=""><img src="/dist/img/logo.png" alt="American Museum of Natural History"/></a></div>
	<div class="site-title"><h1>Quiz Admin</h1></div>
	<div class="social">
		
	</div>
</header>


<div id="login-splash">
	<div id="form">
		<form action="index.php" method="POST">
			<h3>Log In</h3>

			<div class="form-wrap">
				<label for="username">Username</label>
				<input type="text" name="username" id="username">
			</div>

			<div class="form-wrap">
				<label for="password">Password</label>
				<input type="password" name="password" id="password">
			</div>

			<div class="form-wrap error-wrapper">
				<span><?php echo $message; ?></span>
			</div>

			<div class="form-wrap form-submit">
				<input type="submit" id="submit" value="Log In">
				<input type="hidden" name="submitted" value="true"/>
			</div>

		</form>
	</div>
</div>
<script>
	$(document).ready(function(){

	});
</script>

</body>
</html>