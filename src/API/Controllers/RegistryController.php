<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 13:56
 */

namespace API\Controllers;

use Infrastructure\Doctrine\Repositories\RegistryRepository;
use Models\Factories\RegistryFactory;
use Models\RegistryModel as Registry;
use Models\RegistryModel;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistryController
{
    public function isValidType($registerType)
    {
        if ($registerType === RegistryFactory::CAR_REGISTRY ||
            $registerType === RegistryFactory::DEPOSIT_REGISTRY ||
            $registerType === RegistryFactory::POLICY_REGISTRY) {
            return true;
        } else {
            return false;
        }
    }

    public function addRegistry(Application $app, Request $request)
    {
        /** @var RegistryFactory $registryFactory */
        $registryFactory = new RegistryFactory();
        $type = $request->get('type');

        if ($this->isValidType($type) === true) {
            $obj = $registryFactory->create($type, $request->get('name'));
            $app['repositories.registry']->save($obj);

            return new Response('OK', 201);
        } else {
            return new Response("Nie znaleziono typu '{$type}'", 404);
        }
    }

    /**
     * @param Application $app
     * @param             $id
     *
     * @return Response
     */
    public function findRegistryById(Application $app, $id)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);

        return ($getRegistry === null) ?
            new Response("Nie znaleziono rejestru o id={$id}", 404)
            :
            $app->json($getRegistry->toArray());
    }

    public function findAllRegistries(Application $app)
    {
        /** @var Registry array $getRegistry */
        $getRegistry = $app['repositories.registry']->findAll();
        $tab = [];


        /**
         * @var  $i
         * @var  RegistryModel $register
         */
        foreach ($getRegistry as $id => $register) {
            $tab[$id] = $register->toArray();
        }
        return $app->json($tab);
    }

    public function modifyRegistryById(Application $app, Request $request, $id)
    {
        /** @var RegistryRepository $getRegistry */
        $getRegistry = $app['repositories.registry'];

        /** @var RegistryModel $getById */
        $getById = $getRegistry->find($id);

        if ($getRegistry === null) {
            return new Response("Nie znaleziono rejestru o id={$id}", 404);
        } else {
            $getRegistry->modifyOne($getById, $id, $request->get('name'));
            $app['repositories.registry']->save($getById);

            return new Response('OK', 200);
        }
    }

    public function deleteRegistryById(Application $app, $id)
    {
        /** @var RegistryRepository $getRegistry */
        $getRegistry = $app['repositories.registry'];

        /** @var RegistryModel $getById */
        $getById = $getRegistry->find($id);
        if ($getById === null) {
            return new Response("Nie odnaleziono rejestru o id={$id}", 404);
        } else {
            $getRegistry->deleteOne($getById);
            return new Response('OK', 200);
        }
    }
}
