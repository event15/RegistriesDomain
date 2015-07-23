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


        $ControllerCollection->put('/registry/{type}', function(Request $request, $type) {
            $registryFactory = new RegistryFactory();


            $obj = $registryFactory->create($request->get('name'), $type, $request->get('createdBy'));
            $obj->changeName($request->get('name') . " " . $obj->showDate("Y"));
            var_dump($obj);

            //$obj->


            return new Response("OK", 200);
        })->assert('type', RegistryFactory::CAR_REGISTRY . '|' . RegistryFactory::DEPOSIT_REGISTRY . '|' . RegistryFactory::POLICY_REGISTRY);


        $ControllerCollection->post('/registry/{type}', function(Request $request, $type) {


        });
        return $ControllerCollection;
    }

}