<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 16.07.15
 * Time: 09:36
 */

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;


$app->mount('/registry', new \API\Controllers\RegistryControllerProvider());
$app->run();