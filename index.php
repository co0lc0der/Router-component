<?php
$config = require __DIR__ . '/Router/config.php';
require __DIR__ . '/Router/Router.php';

$router = new Router($config['routes'], $config['tplpath']);
$router->run();
