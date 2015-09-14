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

/**
 * Class Create
 *
 * @package Madkom\Registries\Application\RestApi\Controllers\Registry
 */
class Create extends ControllerHelper
{
    /** @var  RegistryFactory $registryFactory Przechowuje fabrykę. */
    protected $registryFactory;
    /** @var  Registry przechowuje rejestr */
    private   $registry;
    /** @var  array zawiera tablicę requestów */
    private   $requestValues;

    /**
     * Tworzy nowy rejestr.
     * @param Application $app
     * @param Request     $request
     *
     * @return Response
     * @throws \Madkom\Registries\Domain\EmptyRegistryTypeException
     * @throws \Madkom\Registries\Domain\UnknownRegistryTypeException
     */
    public function newRegistry(Application $app, Request $request)
    {
        $this->getRequestValues(['name', 'type'], $request);
        $this->prepareRegistry();
        $this->loadRegistryRepository($app)->save($this->registry);

        return new Response('OK', 201);
    }

    /**
     * Pobiera dane z requesta i zwraca tablicę.
     * @param array   $values
     * @param Request $request
     *
     * @return array
     */
    private function getRequestValues(array $values, Request $request)
    {
        foreach ($values as $value) {
            $this->requestValues[$value] = $request->get($value);
        }

        return $this->requestValues;
    }

    /**
     * Funkcja przygotowuje rejestr i tworzy go w zmiennej $this->registry.
     *
     * @throws \Madkom\Registries\Domain\EmptyRegistryTypeException
     * @throws \Madkom\Registries\Domain\UnknownRegistryTypeException
     *
     * @return Registry|\Madkom\Registries\Domain\Car\CarRegistry
     */
    private function prepareRegistry()
    {
        $this->createRegistryFactory();

        $this->registry = $this->registryFactory->create(
            $this->requestValues['type'],
            $this->requestValues['name']
        );

        return $this->registry;
    }

    /**
     * Generuje nową fabrykę RegistryFactory.
     */
    private function createRegistryFactory()
    {
        $this->registryFactory = new RegistryFactory();
    }
}