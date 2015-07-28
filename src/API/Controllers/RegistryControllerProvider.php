<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:52
 */

namespace API\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class RegistryControllerProvider
 *
 * @package API\Controllers
 */
class RegistryControllerProvider implements ControllerProviderInterface
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
        /** @var ControllerCollection $ControllerCollection */
        $ControllerCollection = $app['controllers_factory'];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $ControllerCollection->post('/', 'API\\Controllers\\RegistryRequestsControllers::addRegistry');
        $ControllerCollection->get('/', 'API\\Controllers\\RegistryRequestsControllers::getAllRegistries');
        $ControllerCollection->get('/{id}', 'API\\Controllers\\RegistryRequestsControllers::getRegisterById');
        $ControllerCollection->put('/{id}', 'API\\Controllers\\RegistryRequestsControllers::modifyRegisterById');
        $ControllerCollection->delete('/{id}', 'API\\Controllers\\RegistryRequestsControllers::deleteRegisterById');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return $ControllerCollection;
    }
}