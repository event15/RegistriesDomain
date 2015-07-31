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
                $app['repositories.users']->find($request->get('userId')),
                $app['repositories.registry']->find($request->get('registryId')),
                $request->get('terms')
            ]);

            $app['repositories.element']->save($obj);

            return new Response('OK', 201);
        } else {
            return new Response("Nie znaleziono typu '{$type}'", 404);
        }
    }

    public function findElementById(Application $app, Request $request, $idRejestru, $idElementu)
    {
        $getRegistry = $app['repositories.registry']->find($idRejestru);

        if($getRegistry === null)
        {
            return new Response("Nie znaleziono rejestru o id={$request->get('idRejestru')}", 404);
        }
        else
        {
            /** @var Registry $getRegistry */
            $getElement = $app['repositories.element']->find($idElementu);

            return ($getElement === null) ?
                new Response("Nie znaleziono rejestru o id={$request->get('idElementu')}", 404)
                :
                $app->json($getElement->toArray());
        }

    }

    public function findAllElements(Application $app, Request $request, $idRejestru)
    {
        $getRegistry = $app['repositories.registry']->find($idRejestru);
        $getRegistry->getCars();

        if($getRegistry === null)
        {
            return new Response("Nie znaleziono rejestru o id={$request->get('idRejestru')}", 404);
        }
        else {
            /** @var Registry $getRegistry */
            $getElement = $app['repositories.element']->findAll ();
            $tab = [];

            foreach($getElement as $id => $element) {
                /** @var Registry $register */
                $tab[$id] = $element->toArray ();
            }

            return $app->json ($tab);
        }
    }
}