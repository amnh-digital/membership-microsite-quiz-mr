<?php

require('../../config.php');

// check for user session and make sure they're an admin
$sessionCheck = $app['session']->get('user');
if($sessionCheck === null || $sessionCheck['admin'] == null || $sessionCheck['admin'] != true){
	header('Location: index.php');
}

$stmt = $app['pdo']->prepare('SELECT * FROM users ORDER BY user_id');
$stmt->execute();
$users = $stmt->fetchALL(PDO::FETCH_ASSOC);

//save a row of column names as a header
$headers = array();
foreach($users[0] as $key => $val){
	$headers[0][$key] = $key;
}

// combine the two
$data = array_merge($headers,$users);

// save data as csv
$filename = 'AMNHWhereInTheWorldExport_'.date('m-d-y_hia').'.csv';
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=".$filename);
$output = fopen("php://output", "w");
foreach ($data as $row){
	fputcsv($output, $row); 
}

fclose($output);