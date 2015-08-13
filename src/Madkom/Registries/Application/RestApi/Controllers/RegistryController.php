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
    /**
     * Sprawdza typ podany w request z typem istniejącym w systemie
     * @param $registerType
     *
     * @return bool false|true
     */
    public function isValidType($registerType)
    {
        return $registerType === CarRegistry::TYPE_NAME ?: false;
    }

    /**
     * Dodaje nowy rejestr do bazy danych. Rejestru musi posiadać nazwę i typ podany w request.
     * @param Application $app
     * @param Request     $request
     *
     * @return Response
     * @throws \Madkom\Registries\Domain\EmptyRegistryTypeException
     * @throws \Madkom\Registries\Domain\UnknownRegistryTypeException
     */
    public function addRegistry(Application $app, Request $request)
    {
        $registryFactory     = new RegistryFactory();
        $requestRegistryType = $request->get('type');
        $requestRegistryName = $request->get('name');

        $registry = $registryFactory->create($requestRegistryType, $requestRegistryName);
        $app['repositories.registry']->save($registry);

        return new Response('OK', 201);
    }

    /**
     * Wyświetla wszystkie wpisy w tabeli rejestrów.
     * @param Application $app
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function showRegistries(Application $app)
    {
        $getRegistry = $app['repositories.registry']->findAll();
        $tab = [];

        /**
         * @var  $i
         * @var CarRegistry $registryPosition
         */
        foreach($getRegistry as $i => $registryPosition)
        {
            $tab[] = $registryPosition->getRegistry();
        }

        return $app->json($tab, 200);
    }

    /**
     * Wyświetla pojedynczą pozycję z tabeli rejestrów, wybraną w pasku adresu.
     *
     * @param Application $app
     * @param             $id
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function showRegistry(Application $app, $id)
    {
        /** @var Registry $getRegistry */
        $getRegistry = $app['repositories.registry']->find($id);

        return $app->json($getRegistry->getRegistry(), 200);
    }

    /**
     * Modyfikuje wybrany rejestr. Zmienia jego nazwę.
     * @param Application $app
     * @param Request     $request
     * @param             $id
     *
     * @return Response
     */
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

    /**
     * Usuwa wybrany rejestr z bazy danych
     * @param Application $app
     * @param             $id
     *
     * @return Response
     */
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
}
