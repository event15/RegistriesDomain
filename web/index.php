<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 16.07.15
 * Time: 09:36
 */

use Silex\Application;


require_once __DIR__ . '/../vendor/autoload.php';
require_once '../config/bootstrap.php';



/** @var \Doctrine\ORM\EntityManager $em */
$em = $app[ 'orm.em' ];

$app->mount ('/create', new \API\Controllers\RegistryControllerProvider());

/*
 * $app->mount ('/add', new \API\Controllers\RegistryControllerProvider());
 * $app->mount ('/modify', new \API\Controllers\RegistryControllerProvider());
 * $app->mount ('/delete', new \API\Controllers\RegistryControllerProvider());
 */

$app->run ();
