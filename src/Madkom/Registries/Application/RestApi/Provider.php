<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 31.07.15
 * Time: 22:25
 */

namespace Madkom\Registries\Application\RestApi;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class Provider implements ControllerProviderInterface
{
    const REGISTRY    = "Madkom\\Registries\\Application\\RestApi\\Controllers\\Registry\\";
    const CONTROLLERS = "Madkom\\Registries\\Application\\RestApi\\Controllers\\Position\\";

    public function connect(Application $app)
    {
        /** @var ControllerCollection $controller */
        $controller = $app['controllers_factory'];

        $controller->post  ('', self::REGISTRY . 'Create::newRegistry');
        $controller->get   ('', self::REGISTRY . 'Show::allRegistries');

        $controller->put   ('/{id}', self::REGISTRY . 'Modify::oneById');
        $controller->get   ('/{id}', self::REGISTRY . 'Show::oneById');
        $controller->delete('/{id}', self::REGISTRY . 'Remove::oneById');

        $controller->post  ('/{id}/pozycje', self::CONTROLLERS . 'Create::newPosition');
        $controller->get   ('/{id}/pozycje', self::CONTROLLERS . 'Show::allPositions');

        $controller->get   ('/{id}/pozycje/{positionId}', self::CONTROLLERS . 'PositionController::showPositions');
        $controller->put   ('/{id}/pozycje/{positionId}', self::CONTROLLERS . 'PositionController::modifyPosition');
        $controller->delete('/{id}/pozycje/{positionId}', self::CONTROLLERS . 'PositionController::deletePosition');

        return $controller;
    }
}
