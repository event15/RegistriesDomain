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
         * Operacje na rejestrach
         *
         * host/web/rejestry/
         * host/web/rejestry/{id}
         */
        $controller->post('', 'API\\Controllers\\RegistryController::addRegistry');
        $controller->post('/', 'API\\Controllers\\RegistryController::addRegistry');
        $controller->get('', 'API\\Controllers\\RegistryController::findAllRegistries');
        $controller->get('/', 'API\\Controllers\\RegistryController::findAllRegistries');
        $controller->get('/{id}', 'API\\Controllers\\RegistryController::findRegistryById');
        $controller->put('/{id}', 'API\\Controllers\\RegistryController::modifyRegistryById');
        $controller->delete('/{id}', 'API\\Controllers\\RegistryController::deleteRegistryById');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /**
         * Operacje na elementach rejestrów
         *
         * host/web/rejestry/{id}/elementy
         * host/web/rejestry/{id}/elementy/{idElementu}
         */
        $controller->post('/{id}/elementy', 'API\\Controllers\\ElementController::addElement');
        $controller->get('/{id}/elementy', 'API\\Controllers\\ElementController::findAllElements');
        $controller->get('/{id}/elementy/{idElementu}', 'API\\Controllers\\ElementController::findElementById');
        $controller->put('/{id}/elementy/{idElementu}', 'API\\Controllers\\ElementController::modifyElement');
        $controller->delete('/{id}/elementy/{idElementu}', 'API\\Controllers\\ElementController::deleteElement');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /**
         * host/web/rejestry/{typ}/{id}/
         */
        $controller->get('/{id}/elementy/{idElementu}/', 'API\\Controllers\\ElementController::addTermin');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return $controller;
    }
}
