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



$stmt = $app['pdo']->prepare('SELECT * FROM questions WHERE question_id = :id');
$stmt->bindValue(':id', 1);
$stmt->execute();
$questionInfo = $stmt->fetch(PDO::FETCH_ASSOC);

echo '<div style="display:none;">'.$questionInfo['question_answer'].'</div>';


?>