<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 13:56
 */

namespace Madkom\Registries\Application\RestApi\Controllers;

use Madkom\Registries\Domain\Car\CarRegistry;
use Madkom\Registries\Domain\Registry;
use Madkom\Registries\Domain\RegistryFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistryController
{
    public function isValidType($registerType)
    {
        if ($registerType === CarRegistry::TYPE_NAME)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function addRegistry(Application $app, Request $request)
    {
        $registryFactory = new RegistryFactory();

        $registry = $registryFactory->create($request->get('type'), $request->get('name'));
        $app['repositories.registry']->save($registry);

        return new Response('OK', 201);
    }

    public function showRegistries(Application $app)
    {
        $getRegistry = $app['repositories.registry']->findAll();
        $tab = [];
        /**
         * @var  $i
         * @var CarRegistry $registry
         */
        foreach($getRegistry as $i => $registry)
        {
            $tab[] = $registry->getRegistry();
        }

        return $app->json($tab, 200);
    }

    public function showRegistry(Application $app, $id)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);

        return $app->json($getRegistry->getRegistry(), 200);
    }
}
