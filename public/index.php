<?php

use Highpoint\Core\Env\Env;
use Highpoint\Core\Route\Generate as RouteGenerate;

require __DIR__.'/../vendor/autoload.php';

// set env variable
Env::setPath(__DIR__ . '/../.env')->load();

echo ( new RouteGenerate() )->findRoutes();
