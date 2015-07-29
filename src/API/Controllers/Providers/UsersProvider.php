<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 29.07.15
 * Time: 09:41
 */

namespace API\Controllers\Providers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class UsersProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        /** @var ControllerCollection $ControllerCollection */
        $ControllerCollection = $app['controllers_factory'];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $ControllerCollection->post('/', 'API\\Controllers\\Requests\\UsersRequests::addUser');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return $ControllerCollection;
    }
}