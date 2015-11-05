<?php

namespace Madkom\Registries\Application\RestApi;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class Provider
 *
 * @package Madkom\Registries\Application\RestApi
 */
class Provider implements ControllerProviderInterface
{
    const REGISTRY    = "Madkom\\Registries\\Application\\RestApi\\Controllers\\Registry\\";
    const CONTROLLERS = "Madkom\\Registries\\Application\\RestApi\\Controllers\\Position\\";

    /**
     * @param Application $app
     *
     * @return ControllerCollection
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controller */
        $controller = $app['controllers_factory'];

        $controller->get('/rejestry', self::REGISTRY . 'Show::allRegistries');
        $controller->post('/rejestry', self::REGISTRY . 'Create::newRegistry');

        $this->selectedRegistry($controller);

        $controller->post('/rejestry/{registryId}/pozycje', self::CONTROLLERS . 'Create::newPosition');
        $controller->get('/rejestry/{registryId}/pozycje', self::CONTROLLERS . 'Show::allPositions');

        $controller->get('/rejestry/{registryId}/pozycje/{positionId}', self::CONTROLLERS . 'Show::positionById');
        $controller->put('/rejestry/{registryId}/pozycje/{positionId}', self::CONTROLLERS . 'Modify::positionById');
        $controller->delete('/rejestry/{registryId}/pozycje/{positionId}', self::CONTROLLERS . 'Remove::positionById');

        return $controller;
    }

    /**
     * @param $controller
     */
    private function selectedRegistry($controller)
    {
        $controller->put('/rejestry/{registryId}', self::REGISTRY . 'Modify::oneById');
        $controller->get('/rejestry/{registryId}', self::REGISTRY . 'Show::oneById');
        $controller->delete('/rejestry/{registryId}', self::REGISTRY . 'Remove::oneById');
    }
}


