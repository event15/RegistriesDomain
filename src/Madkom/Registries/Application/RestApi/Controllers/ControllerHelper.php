<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 20.08.15
 * Time: 12:14
 */

namespace Madkom\Registries\Application\RestApi\Controllers;

use Madkom\Registries\Domain\EmptyRegistryException;
use Silex\Application;

class ControllerHelper
{
    public function findAndCheckRegistry(Application $app, $registryId)
    {
        $foundRegistry = $this->loadRegistryRepository($app)->find($registryId);

        if ($foundRegistry === null) {
            throw new EmptyRegistryException('Wybrany rejestr jest pusty bądź nie istnieje.');
        }

        return $foundRegistry;
    }

    public function loadRegistryRepository(Application $app)
    {
        return $app['repositories.registry'];
    }
}