<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 16.07.15
 * Time: 09:36
 */

use Silex\Application;
use Madkom\Registries\Application\RestApi\Provider;

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../config/bootstrap.php';



/** @var \Doctrine\ORM\EntityManager $em */
$em = $app[ 'orm.em' ];
$app->mount('/rejestry', new Provider());

$app->run();
