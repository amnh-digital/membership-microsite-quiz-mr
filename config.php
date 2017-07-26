<?php 

$dsn = $dbopts['scheme']."://host=".$dbopts['host'].";port=".$dbopts['port'].";dbname=".ltrim($dbopts["path"],'/').";user=".$dbopts['user'].";password=".$dbopts['pass'];

?>