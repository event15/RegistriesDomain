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
    const CONTROLLERS = 'Madkom\\Registries\\Application\\RestApi\\Controllers\\';

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controller */
        $controller = $app['controllers_factory'];

        /**
         * Operacje na rejestrach
         *
         * host/web/rejestry/
         * host/web/rejestry/{id}
         */
        $controller->post  ('', self::CONTROLLERS . 'RegistryController::addRegistry');
        $controller->get   ('', self::CONTROLLERS . 'RegistryController::showRegistries');

        $controller->put   ('/{id}', self::CONTROLLERS . 'RegistryController::modifyRegistry')->assert('id', '\d+');
        $controller->get   ('/{id}', self::CONTROLLERS . 'RegistryController::showRegistry')  ->assert('id', '\d+');
        $controller->delete('/{id}', self::CONTROLLERS . 'RegistryController::deleteRegistry')->assert('id', '\d+');

        /**
         * Operacje na elementach rejestrów
         *
         * host/web/rejestry/{id}/elementy
         * host/web/rejestry/{id}/elementy/{idElementu}
         */

        $controller->post  ('/{id}/pozycje', self::CONTROLLERS . 'PositionController::addPosition');
        $controller->get   ('/{id}/pozycje', self::CONTROLLERS . 'PositionController::showPositions');

        $controller->get   ('/{id}/pozycje/{positionId}', self::CONTROLLERS . 'PositionController::showPositions');
        $controller->put   ('/{id}/pozycje/{positionId}', self::CONTROLLERS . 'PositionController::modifyPosition');
        $controller->delete('/{id}/pozycje/{positionId}', self::CONTROLLERS . 'PositionController::deletePosition');

        return $controller;
    }
}
