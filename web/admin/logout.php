<?php

require('../../config.php');

$app['session']->clear();

header('Location: index.php');