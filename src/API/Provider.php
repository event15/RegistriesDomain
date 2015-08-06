<?php
/**
 * Created by PhpStorm.
 * User: event15
 * Date: 31.07.15
 * Time: 22:25
 */

namespace API;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class Provider implements ControllerProviderInterface
{
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /**
         * host/web/rejestry/
         * host/web/rejestry/{id}
         */
        $controller->post('/', 'API\\Controllers\\RegistryController::addRegistry');
        $controller->get('/', 'API\\Controllers\\RegistryController::findAllRegistries');
        $controller->get('/{id}', 'API\\Controllers\\RegistryController::findRegistryById');
        $controller->put('/{id}', 'API\\Controllers\\RegistryController::modifyRegistryById')->value('id', 1);
        $controller->delete('/{id}', 'API\\Controllers\\RegistryController::deleteRegistryById');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /**
         * host/web/rejestry/{typ}/{id}
         */
        $controller->post('/{id}/elementy', 'API\\Controllers\\ElementController::addElement');
        $controller->get('/{id}/elementy', 'API\\Controllers\\ElementController::findAllElements');
        $controller->get('/{id}/elementy/{idElementu}', 'API\\Controllers\\ElementController::findElementById');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return $controller;
    }
}
