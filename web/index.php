<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__.'/../app/config/config.php';
require __DIR__.'/../app/app.php';
require __DIR__.'/../app/config/routes.php';

$app->run();