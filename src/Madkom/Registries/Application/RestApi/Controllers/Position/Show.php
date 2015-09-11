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
    public function allPositions(Application $app, $id)
    {
        $getElement = $app['repositories.position']->findAll('Madkom\\Registries\\Domain\\Car\\Car', $id);

        $tab = [];

        foreach ($getElement as $id => $element) {
            $tab[$id] = $element->toArray();
        }

        return $app->json($tab);
    }

    public function positionById(Application $app, $positionId)
    {
        $getElement = $app['repositories.position']->find('Madkom\\Registries\\Domain\\Car\\Car', $positionId);

        return ($getElement === null) ?
            new Response("Nie znaleziono rejestru o id={$positionId}", 404)
            :
            $app->json($getElement->toArray());
    }
}