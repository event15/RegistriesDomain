<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 16.07.15
 * Time: 09:36
 */

use Madkom\Registries\Application\RestApi\Provider;

require_once __DIR__ . '/../config/bootstrap.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = $app['orm.em'];
$app->mount('/api/', new Provider());
$app->run();
