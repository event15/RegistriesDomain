<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:52
 */

namespace API\Controllers\Providers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class RegistryProvider
 *
 * @package API\Controllers
 */
class RegistryProvider implements ControllerProviderInterface
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
        /**
         * host/web/rejestry/
         * host/web/rejestry/{id}
         */
        $ControllerCollection->post('/', 'API\\Controllers\\RegistryController::addRegistry');
        $ControllerCollection->get('/', 'API\\Controllers\\RegistryController::getAllRegistries');
        $ControllerCollection->get('/{id}', 'API\\Controllers\\RegistryController::getRegisterById');
        $ControllerCollection->put('/{id}', 'API\\Controllers\\RegistryController::modifyRegisterById');
        $ControllerCollection->delete('/{id}', 'API\\Controllers\\RegistryController::deleteRegisterById');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return $ControllerCollection;
    }
}