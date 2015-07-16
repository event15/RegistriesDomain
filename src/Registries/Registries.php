<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 16.07.15
 * Time: 09:43
 */

namespace Registries;

use Silex\Application;
use Silex\ControllerProviderInterface;
class Registries implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/{id}', function (Application $app, $id) {
            return 'Hello ' . $app->escape($id);
        })->value('id', 1)
          ->assert('id', '\d+');



        return $controllers;
    }
}