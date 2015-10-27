<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 20.08.15
 * Time: 12:23
 */

namespace Madkom\Registries\Application\RestApi\Controllers\Registry;

use Madkom\Registries\Application\RestApi\Controllers\ControllerHelper;
use Silex\Application;

class Show extends ControllerHelper
{
    public function oneById(Application $app, $id)
    {
        /** @var \Madkom\Registries\Domain\Registry $currentRegistry */
        $currentRegistry = $this->findAndCheckRegistry($app, $id);

        return $app->json($currentRegistry->registryToArray(), 200);
    }

    public function allRegistries(Application $app)
    {
        /** @var $currentRegistry */
        $currentRegistry = $this->loadRegistryRepository($app)
                                ->findAll();
        $allRegistries   = [];

        /**
         * @var                                    $i
         * @var \Madkom\Registries\Domain\Registry $registryPosition
         */
        foreach ($currentRegistry as $registryPosition) {
            $allRegistries[] = $registryPosition->registryToArray();
        }

        return $app->json($allRegistries, 200);
    }
}