<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:52
 */

namespace API\Controllers;

use Models\Registries\Registry;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Models\Registries\RegistryFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistryControllerProvider
 *
 * @package API\Controllers
 */
class RegistryControllerProvider implements ControllerProviderInterface
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $facotry */
        $ControllerCollection = $app['controllers_factory'];

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $ControllerCollection->post('/', function (Application $app, Request $request)
        {
            $registryFactory = new RegistryFactory();
            $type = $request->get('type');

            if ($type === RegistryFactory::CAR_REGISTRY     ||
                $type === RegistryFactory::DEPOSIT_REGISTRY ||
                $type === RegistryFactory::POLICY_REGISTRY)
            {
                $obj = $registryFactory->create($request->get('name'), $type);
                $app['repositories.registry']->save($obj);

                return new Response('OK', 201);
            }
            else
            {
                return new Response("Nie znaleziono typu o nazwie '{$type}'", 404);
            }
        });

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $ControllerCollection->get ('/', function (Application $app)
        {
            $showAllRegistries = $app['repositories.registry']->findAll();
            $tab = [];

            foreach($showAllRegistries as $id => $register)
            {
                /** @var Registry $register */
                $tab[$id] = $register->toArray();
            }

            return $app->json ($tab); // 200 OK
        });

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $ControllerCollection->get('/{id}', function (Application $app, $id)
        {
            /** @var Registry $getRegistry */
            $getRegistry = $app['repositories.registry']->find($id);

            return ($getRegistry === null) ?
                new Response("Nie znaleziono rejestru o id={$id}", 404)
                :

                $app->json($getRegistry->toArray ()); // 200 OK

        })->assert('id', '\d+');

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $ControllerCollection->delete ('/{type}/{id}', function (Application $app, $id)
        {
            /** @var Registry $getRegistry */
            $getRegistry = $app['repositories.registry']->find ($id);
            if ($getRegistry === null) {
                return new Response("Nie znaleziono rejestru o id={$id}", 404);
            } else {
                $app['repositories.registry']->deleteOne ($getRegistry);

                return new Response('OK', 200);
            }

        })->assert ('type', RegistryFactory::CAR_REGISTRY . '|' . RegistryFactory::DEPOSIT_REGISTRY . '|' . RegistryFactory::POLICY_REGISTRY)
          ->assert ('id', '\d+');

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $ControllerCollection->put ('/{type}/{id}', function (Application $app, $id, Request $request) {
            $getRegistry = $app['repositories.registry']->find ($id);
            if ($getRegistry === null) {
                return new Response("Nie znaleziono rejestru o id={$id}", 404);
            } else {
                $app['repositories.registry']->changeName ($request->get ('name'), $getRegistry);

                return new Response('OK', 200);
            }

        })->assert ('type', RegistryFactory::CAR_REGISTRY . '|' . RegistryFactory::DEPOSIT_REGISTRY . '|' . RegistryFactory::POLICY_REGISTRY);

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return $ControllerCollection;
    }
}