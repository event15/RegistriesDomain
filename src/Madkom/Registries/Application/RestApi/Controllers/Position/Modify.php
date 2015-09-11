<?php

namespace Madkom\Registries\Application\RestApi\Controllers\Position;

use Madkom\Registries\Application\RestApi\Controllers\ControllerHelper;
use Madkom\Registries\Domain\EmptyRegistryException;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class Modify extends ControllerHelper
{
    public function positionById(Application $app, Request $request, $id, $positionId)
    {
        $helper = new ControllerHelper();
        $currentRegistry = $helper->findAndCheckRegistry($app, $id);

        /** @var \Madkom\Registries\Domain\Car\Car $getElement */
        $getElement = $app['repositories.position']->find('Madkom\\Registries\\Domain\\Car\\Car', $positionId);

        if ($getElement === null) {
            throw new EmptyRegistryException('Wybrany element nie istnieje.');
        }


        $getElement->changeBrand($request->get('brand'));
        $getElement->changeModel($request->get('model'));
        $getElement->changeOthers($request->get('others'));
        $getElement->changeRegistrationNumber($request->get('registrationNumber'));


        $app['repositories.position']->prepareToSave($getElement);
        $app['repositories.registry']->save($currentRegistry);


        return new Response('OK', 201);
    }
}