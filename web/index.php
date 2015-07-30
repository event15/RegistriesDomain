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

$app->mount ('/rejestry', new \API\Controllers\Providers\RegistryProvider());
$app->mount ('/elementy', new \API\Controllers\Providers\RegistryElementProvider());
$app->mount ('/uzytkownicy', new \API\Controllers\Providers\UsersProvider());

$app->run ();
