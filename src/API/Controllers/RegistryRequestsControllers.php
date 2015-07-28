<?php
/**
 * Created by PhpStorm.
 * User: PFIG
 * Date: 2015-07-28
 * Time: 19:55
 */

namespace API\Controllers;

use Models\Registries\Registry;
use Models\Registries\RegistryFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistryRequestsControllers
 * @package API\Controllers
 */
class RegistryRequestsControllers
{
    /**
     * @param \Silex\Application                        $app
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addRegistry(Application $app, Request $request)
    {
        /** @var RegistryFactory $registryFactory */
        $registryFactory = new RegistryFactory();
        $type = $request->get('type');

        if ($type === RegistryFactory::CAR_REGISTRY ||
            $type === RegistryFactory::DEPOSIT_REGISTRY ||
            $type === RegistryFactory::POLICY_REGISTRY
        ) {
            $obj = $registryFactory->create($request->get('name'), $type);
            $app['repositories.registry']->save($obj);

            return new Response('OK', 201);
        } else {
            return new Response("Nie znaleziono typu '{$type}'", 404);
        }
    }

    /**
     * @param \Silex\Application $app
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getAllRegistries(Application $app)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->findAll();
        $tab = [];

        foreach ($getRegistry as $id => $register) {
            /** @var Registry $register */
            $tab[$id] = $register->toArray();
        }

        return $app->json($tab);
    }

    /**
     * @param \Silex\Application                        $app
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRegisterById(Application $app, Request $request)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->find($request->get('id'));

        return ($getRegistry === null) ?
            new Response("Nie znaleziono rejestru o id={$request->get('id')}", 404)
            :
            $app->json($getRegistry->toArray());
    }

    /**
     * @param \Silex\Application                        $app
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function modifyRegisterById(Application $app, Request $request)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->find($request->get('id'));
        if ($getRegistry === null) {
            return new Response("Nie znaleziono rejestru o id={$request->get('id')}", 404);
        } else {
            $app['repositories.registry']->changeName($request->get('name'), $getRegistry);

            return new Response('OK', 200);
        }
    }

    /**
     * @param \Silex\Application                        $app
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteRegisterById(Application $app, Request $request)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->find($request->get('id'));
        if ($getRegistry === null) {
            return new Response("Nie znaleziono rejestru o id={$request->get('id')}", 404);
        } else {
            $app['repositories.registry']->deleteOne($getRegistry);

            return new Response('OK', 200);
        }
    }
}