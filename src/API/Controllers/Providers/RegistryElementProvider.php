<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 30.07.15
 * Time: 09:25
 */

namespace API\Controllers\Providers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class RegistryElementProvider implements ControllerProviderInterface
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
         * host/web/rejestry/{typ}/
         * host/web/rejestry/{typ}/{id}
         */
        $ControllerCollection->post('/', 'API\\Controllers\\RegistryElementController::addObject');
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        return $ControllerCollection;
    }
}