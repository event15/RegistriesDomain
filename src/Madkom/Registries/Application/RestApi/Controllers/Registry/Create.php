<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 20.08.15
 * Time: 12:23
 */

namespace Madkom\Registries\Application\RestApi\Controllers\Registry;

use Madkom\Registries\Application\RestApi\Controllers\ControllerHelper;
use Madkom\Registries\Domain\RegistryFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Create extends ControllerHelper
{
    /** @var  RegistryFactory $registryFactory */
    protected $registryFactory;
    private   $registry;
    private   $requestValues;

    public function newRegistry(Application $app, Request $request)
    {
        $this->getRequestValues(['name', 'type'], $request);
        $this->prepareRegistry();
        $this->loadRegistryRepository($app)->save($this->registry);

        return new Response('OK', 201);
    }

    private function getRequestValues(array $values, Request $request)
    {
        foreach($values as $value) {
            $this->requestValues[$value] = $request->get($value);
        }

        return $this->requestValues;
    }

    private function createRegistryFactory()
    {
        $this->registryFactory = new RegistryFactory();
    }

    private function prepareRegistry()
    {
        $this->createRegistryFactory();

        $this->registry = $this->registryFactory->create(
            $this->requestValues['type'],
            $this->requestValues['name']
        );

        return $this->registry;
    }
}