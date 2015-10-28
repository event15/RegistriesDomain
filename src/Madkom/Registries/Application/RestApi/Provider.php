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

        $controller->post('', self::REGISTRY . 'Create::newRegistry');
        $controller->get('', self::REGISTRY . 'Show::allRegistries');

        $this->selectedRegistry($controller);

        $controller->post('/{registryId}/pozycje', self::CONTROLLERS . 'Create::newPosition');
        $controller->get('/{registryId}/pozycje', self::CONTROLLERS . 'Show::allPositions');

        $controller->get('/{registryId}/pozycje/{positionId}', self::CONTROLLERS . 'Show::positionById');
        $controller->put('/{registryId}/pozycje/{positionId}', self::CONTROLLERS . 'Modify::positionById');
        $controller->delete('/{registryId}/pozycje/{positionId}', self::CONTROLLERS . 'Remove::positionById');

        return $controller;
    }

    /**
     * @param $controller
     */
    private function selectedRegistry($controller)
    {
        $controller->put('/{registryId}', self::REGISTRY . 'Modify::oneById');
        $controller->get('/{registryId}', self::REGISTRY . 'Show::oneById');
        $controller->delete('/{registryId}', self::REGISTRY . 'Remove::oneById');
    }
}


