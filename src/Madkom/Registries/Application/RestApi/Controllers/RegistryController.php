<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 13:56
 */

namespace Madkom\Registries\Application\RestApi\Controllers;

use Madkom\Registries\Domain\Car\CarRegistry;
use Madkom\Registries\Domain\EmptyRegistryException;
use Madkom\Registries\Domain\Registry;
use Madkom\Registries\Domain\RegistryFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistryController
{
    /** @var  RegistryFactory $registryFactory */
    protected $registryFactory;
    private $requestValues;

    public function createRegistry(Application $app, Request $request)
    {
        $this->getRequestValues(['name', 'type'], $request);
        $this->newRegistry($app);

        return new Response('OK', 201);
    }

    public function showRegistries(Application $app)
    {
        $currentRegistry = $this->getRegistry($app)->findAll();
        $allRegistries = [];

        /**
         * @var  $i
         * @var CarRegistry $registryPosition
         */
        foreach($currentRegistry as $i => $registryPosition)
        {
            $allRegistries[] = $registryPosition->RegistryToArray();
        }

        return $app->json($allRegistries, 200);
    }

    public function showRegistry(Application $app, $id)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);

        return $app->json($getRegistry->RegistryToArray(), 200);
    }

    public function modifyRegistry(Application $app, Request $request, $id)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);

        if($getRegistry === null)
        {
            return new Response("Nie odnaleziono rejestru o id='{$id}'");
        }
        else
        {
            $getRegistry->changeName($request->get('name'));
            $app['repositories.registry']->save($getRegistry);
        }

        return new Response('OK', 200);
    }

    public function deleteRegistry(Application $app, $id)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);
        if($getRegistry === null)
        {
            return new Response("Nie odnaleziono rejestru o id='{$id}'");
        }
        else
        {
            $app['repositories.registry']->delete($getRegistry);
        }

        return new Response('OK', 200);
    }

    private function createRegistryFactory()
    {
        $this->registryFactory = new RegistryFactory();
    }

    private function getRequestValues(array $values, Request $request)
    {
        foreach($values as $value) {
            $this->requestValues[$value] = $request->get($value);
        }

        return $this->requestValues;
    }
    private function newRegistry(Application $app)
    {
        $this->createRegistryFactory();

        $newRegistry = $this->registryFactory->create(
            $this->requestValues['type'],
            $this->requestValues['name']
        );

        $app['repositories.registry']->save($newRegistry);
    }

    public function getRegistry(Application $app)
    {
        return $app['repositories.registry'];
    }
}
