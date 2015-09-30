<?php
error_reporting(E_ALL | E_STRICT);
require_once __DIR__. '/../vendor/autoload.php';

use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$app = new Silex\Application();
$app[ 'debug' ] = 1;

$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver'   => 'pdo_mysql',
        'charset'  => 'utf8',
        'host'     => 'localhost',
        'user'     => 'root',
        'password' => 'root',
        'dbname'   => 'mistrz'
    ]
]);

$app->register(new DoctrineOrmServiceProvider(), [
    'orm.em.options' => [
        'mappings' => [
            [
                'type'      => 'yml',
                'namespace' => 'Madkom\Registries\Domain',
                'path'      => [ __DIR__ . '/../src/Madkom/Registries/Infrastructure/Doctrine/Mappings' ]
            ],
            [
                'type'      => 'yml',
                'namespace' => 'Madkom\Registries\Domain\Car',
                'path'      => [ __DIR__ . '/../src/Madkom/Registries/Infrastructure/Doctrine/Mappings' ]
            ]
        ]
    ]
]);

$config = Setup::createYAMLMetadataConfiguration($app['orm.em.options']['mappings'][0]['path'], $app['debug']);
$app['orm.em'] = EntityManager::create($app['db.options'], $config);

$app['repositories.registry'] = new \Madkom\Registries\Infrastructure\Doctrine\Repositories\RegistryRepositoryImpl($app['orm.em']);
$app['repositories.position'] = new \Madkom\Registries\Infrastructure\Doctrine\Repositories\PositionRepositoryImpl($app['orm.em']);
