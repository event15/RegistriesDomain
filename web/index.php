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

$app->mount('/rejestry', new API\Provider());
//$app->mount ('/elementy', new \API\Controllers\Providers\RegistryElementProvider());
//$app->mount ('/uzytkownicy', new \API\Controllers\Providers\UsersProvider());

$app->run();


/*$registryFactory = new Models\Factories\RegistryFactory();
$autka = $registryFactory->create('samochody', 'Autka 2015');

$daneAuta = array(
    1, 'fiat', 'panda', 'ZSD 12345', 'PZU', 'inne komentarze', 'plik z załącznikiem', 'Marek', 2, 'today'
);

$elementFactory = new Models\Factories\ElementFactory();
$autko = $elementFactory->create('samochod', $daneAuta);

$autka->addCar($autko);


var_dump($autka);
echo "<hr>";*/
