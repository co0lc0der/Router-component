<?php
$config = require __DIR__ . '/Router/config.php';
require __DIR__ . '/Router/Router.php';

var_dump($_SERVER);var_dump($config);die;
$router = new Router($config['routes'], $config['tplpath']);
$router->run();
