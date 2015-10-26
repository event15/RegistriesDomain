<?php
// cli-config.php
require_once 'config/bootstrap.php';

$helperSet = new  \Symfony\Component\Console\Helper\HelperSet([
    'db'   => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($app['orm.em']->getConnection()),
    'em'   => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($app['orm.em'])
]);

return $helperSet;
