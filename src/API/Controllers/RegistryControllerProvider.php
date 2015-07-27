<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.07.15
 * Time: 13:52
 */

namespace API\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Models\Registries\RegistryFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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


        $ControllerCollection->post ('/{type}', function (Application $app, Request $request, $type) {
            $registryFactory = new RegistryFactory();

            // Tworzenie nowego rejestru
            $obj = $registryFactory->create ($request->get ('name'), $type);

            $app['repositories.registry']->save ($obj);

            return new Response("OK", 200);
        })->assert ('type', RegistryFactory::CAR_REGISTRY . '|' . RegistryFactory::DEPOSIT_REGISTRY . '|' . RegistryFactory::POLICY_REGISTRY);


        $ControllerCollection->get('/{type}', function (Application $app){

            $showAllRegistries = $app['repositories.registry']->findAll();
            $tab = array();

            foreach($showAllRegistries as $id => $register)
            {
                $tab[$id] = json_encode($register->toArray());
            }
            var_dump($tab);
            return 1;
        });


        $ControllerCollection->get('/{type}/{id}', function (Application $app, $id) {

            $showRegistry = $app['repositories.registry']->find ($id);
            return (empty($showRegistry) ?  new Response("Nie znaleziono rejestru o id={$id}", 404) : $app->json($showRegistry->toArray()));

        })->value('id', 1)
          ->assert ('type', RegistryFactory::CAR_REGISTRY . '|' . RegistryFactory::DEPOSIT_REGISTRY . '|' . RegistryFactory::POLICY_REGISTRY,
            'id', '\d+'
        );

        return $ControllerCollection;
    }

}