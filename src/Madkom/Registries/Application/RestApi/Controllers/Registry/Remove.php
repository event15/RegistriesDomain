<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 20.08.15
 * Time: 12:23
 */

namespace Madkom\Registries\Application\RestApi\Controllers\Registry;

use Madkom\Registries\Application\RestApi\Controllers\ControllerHelper;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class Remove extends ControllerHelper
{
    public function oneById(Application $app, $id)
    {
        /** @var \Madkom\Registries\Domain\Registry $currentRegistry */
        $currentRegistry = $this->findAndCheckRegistry($app, $id);
        $app['repositories.registry']->delete($currentRegistry);

        return new Response('OK', 200);
    }
}