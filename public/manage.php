<?php
require dirname(__DIR__).'/vendor/autoload.php';
require dirname(__DIR__).'/autoload.php';

$app_factory = require dirname(__DIR__).'/bootstrap/app.php';
$app = $app_factory();
$app->run_cli($argv);
