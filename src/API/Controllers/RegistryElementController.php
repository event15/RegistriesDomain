<?php
/**
 * Created by PhpStorm.
 * User: PFIG
 * Date: 2015-07-28
 * Time: 21:44
 */

namespace API\Controllers;

use Models\Registries\CarRegistry\Car;
use Models\Registries\RegistryFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class RegistryElementController
{
    public function addObject(Application $app, Request $request)
    {
        $type = $request->get('type');
        $user = $app['repositories.users']->find(1);

        if ($type === RegistryFactory::CAR_REGISTRY ||
            $type === RegistryFactory::DEPOSIT_REGISTRY ||
            $type === RegistryFactory::POLICY_REGISTRY
        ) {
            $obj = new Car([
                $request->get('brand'),
                $request->get('model'),
                $request->get('registrationNumber'),
                $request->get('insurer'),
                $request->get('others'),
                $request->get('attachments'),
                app['repositories.users']->find($request->get('userId')),
                $app['repositories.registry']->find($request->get('registryId')),
                $request->get('terms')
            ]);

            var_dump($obj);
            $app['repositories.element']->save($obj);

            return new Response('OK', 201);
        } else {
            return new Response("Nie znaleziono typu '{$type}'", 404);
        }
    }
}