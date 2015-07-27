<?php
error_reporting(E_ALL | E_STRICT);
require_once __DIR__. '/../vendor/autoload.php';

use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Infrastructure\Doctrine\Repositories\RegistryRepository;

$app = new Silex\Application();
$app[ 'debug' ] = false;


$app->register (new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'mistrz'
    )
));

$app->register (new DoctrineOrmServiceProvider(), array(
    /*'orm.proxies_dir' => array(__DIR__ . '/../src/Infrastructure/Doctrine/Models'),*/
    'orm.em.options' => array(
        'mappings' => array(
            array(
                'type' => 'yml',
                'namespace' => '\Models\Registries',
                'path' => array(__DIR__ . '/../src/Infrastructure/Doctrine/Models'),
            )
        )
    )
));

$config = Setup::createYAMLMetadataConfiguration($app['orm.em.options']['mappings'][0]['path'], $app['debug']);
$app['orm.em'] = EntityManager::create($app['db.options'], $config);

$app['repositories.registry'] = new RegistryRepository($app['orm.em']);