<?php

require dirname(__DIR__).'/vendor/autoload.php';
require dirname(__DIR__).'/autoload.php';

$app = require dirname(__DIR__).'/bootstrap/app.php';
$app->run();