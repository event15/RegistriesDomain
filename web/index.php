<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 16.07.15
 * Time: 09:36
 */

require_once __DIR__.'/../vendor/autoload.php';

$app['debug'] = true;

$app = new Silex\Application();

$app->mount('/samochody', new \Registries\Registries());




$app->run();