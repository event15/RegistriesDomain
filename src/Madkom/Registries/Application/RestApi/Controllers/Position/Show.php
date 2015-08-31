<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 24.08.15
 * Time: 09:09
 */

namespace Madkom\Registries\Application\RestApi\Controllers\Position;

use Madkom\Registries\Application\RestApi\Controllers\ControllerHelper;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Show extends ControllerHelper
{
    public function allPositions(Application $app, Request $request, $id)
    {
        $currentRegistry = $this->findAndCheckRegistry($app, $id);
        $getElement = $app['repositories.position']->findAll('Madkom\\Registries\\Domain\\Car\\CarRegistry', $id);

        $tab = [];

        foreach ($getElement as $id => $element) {
            $tab[$id] = $element->toArray();
        }

        var_dump($getElement);

        return $app->json($tab);
    }
}