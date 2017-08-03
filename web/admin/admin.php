<?php

require('../../config.php');

// check for user session and make sure they're an admin
$sessionCheck = $app['session']->get('user');
if($sessionCheck === null || $sessionCheck['admin'] == null || $sessionCheck['admin'] != true){
	header('Location: index.php');
}

$stmt = $app['pdo']->prepare('SELECT * FROM users');
$stmt->execute();
$users = $stmt->fetchALL(PDO::FETCH_ASSOC);

$countUsers = count($users);


$stmt = $app['pdo']->prepare('SELECT count(*) FROM users WHERE q1 IS NOT NULL AND q2 IS NOT NULL AND q3 IS NOT NULL AND q4 IS NOT NULL AND q5 IS NOT NULL AND q6 IS NOT NULL AND q7 IS NOT NULL AND q8 IS NOT NULL AND q9 IS NOT NULL');
$stmt->execute();
$countCompletedUsers = $stmt->fetch(PDO::FETCH_ASSOC);

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
<body class="admin">

<header>
	<div class="logo"><a href=""><img src="/dist/img/logo.png" alt="American Museum of Natural History"/></a></div>
	<div class="site-title"><h1>Quiz Admin</h1></div>
	<div class="social">
		<a href="logout.php" class="logout-link">logout</a>
	</div>
</header>

<div class="admin-panel">
	
	<div class="header">
		<div class="column first">Total Submissions: <strong><?php echo $countUsers; ?></strong></div>
		<div class="column middle"><a href="download.php" target="new">download results</a></div>
		<div class="column last">Finished Quizes: <strong><?php echo $countCompletedUsers['count']; ?></strong></div>
	</div>


	<div class="row toprow">
		<div class="column wide30">ID</div>
		<div class="column wide180">Name</div>
		<div class="column wide180">Email</div>
		<div class="column wide80">Opt In?</div>
		<div class="column wide80">Source</div>
		<div class="column wide40">Q1</div>
		<div class="column wide40">Q2</div>
		<div class="column wide40">Q3</div>
		<div class="column wide40">Q4</div>
		<div class="column wide40">Q5</div>
		<div class="column wide40">Q6</div>
		<div class="column wide40">Q7</div>
		<div class="column wide40">Q8</div>
		<div class="column wide40">Q9</div>
	</div>

	<?php foreach($users as $user){ ?>
		<div class="row">
			<div class="column wide30"><?php echo $user['user_id'];?></div>
			<div class="column wide180"><?php echo $user['fn'].' '.$user['ln'];?></div>
			<div class="column wide180"><?php echo '....'.substr($user['email'],4); ?></div>
			<div class="column wide80"><?php echo $user['opt_in'];?>&nbsp;</div>
			<div class="column wide80"><?php echo $user['source_code'];?>&nbsp;</div>
			<div class="column wide40"><?php echo $user['q1'];?>&nbsp;</div>
			<div class="column wide40"><?php echo $user['q2'];?>&nbsp;</div>
			<div class="column wide40"><?php echo $user['q3'];?>&nbsp;</div>
			<div class="column wide40"><?php echo $user['q4'];?>&nbsp;</div>
			<div class="column wide40"><?php echo $user['q5'];?>&nbsp;</div>
			<div class="column wide40"><?php echo $user['q6'];?>&nbsp;</div>
			<div class="column wide40"><?php echo $user['q7'];?>&nbsp;</div>
			<div class="column wide40"><?php echo $user['q8'];?>&nbsp;</div>
			<div class="column wide40"><?php echo $user['q9'];?>&nbsp;</div>
		</div>
	<?php } ?>

</div>

</body>
</html>