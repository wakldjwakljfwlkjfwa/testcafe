<?php

require_once __DIR__ . '/../vendor/autoload.php';

define('__APP__', __DIR__ . '/../');

use App\Application;

$app = new Application();
$app->run();
