<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 13:56
 */

namespace Madkom\Registries\Application\RestApi\Controllers;

use Doctrine\ORM\ORMException;
use Madkom\Registries\Domain\Car\CarRegistry;
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
        if ($this->isValidType($request->get('type')))
        {
            $carRegistry = $registryFactory->create(CarRegistry::TYPE_NAME, $request->get('type'));
            $app['repositories.registry']->save($carRegistry);


            return new Response('OK', 200);
        }
        else
        {
            return new Response("Nie istnieje rejestr o typie {$request->get('type')}");
        }
    }

    public function showRegistries(Application $app, Request $request)
    {
        /** @var CarRegistry $getRegistry */
        $getRegistry = $app['repositories.registry']->findAll();
        $getRegistry->toArray();

        return new Response('OK', 200);
    }
}
