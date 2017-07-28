<?php 
date_default_timezone_set('America/New_York');
$dbopts = parse_url(getenv('DATABASE_URL'));

require('vendor/autoload.php');
use Silex\Application;





$app = new Application();
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
   array(
    'pdo.server' => array(
       'driver'   => 'pgsql',
       'user' => $dbopts["user"],
       'password' => $dbopts["pass"],
       'host' => $dbopts["host"],
       'port' => $dbopts["port"],
       'dbname' => ltrim($dbopts["path"],'/')
       )
   )
);

?>