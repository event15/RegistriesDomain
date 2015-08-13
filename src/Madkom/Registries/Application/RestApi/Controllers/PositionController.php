<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 13:56
 */

namespace Madkom\Registries\Application\RestApi\Controllers;

use Madkom\Registries\Domain\Car\CarDto;
use Madkom\Registries\Domain\Car\CarFactory;
use Madkom\Registries\Domain\Car\Term\AC;
use Madkom\Registries\Domain\Department\Department;
use Madkom\Registries\Domain\Department\DepartmentCollection;
use Madkom\Registries\Domain\EmptyRegistryException;
use Madkom\Registries\Domain\PositionFactory;
use Madkom\Registries\Domain\TermDto;
use Madkom\Registries\Domain\TermFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Madkom\Registries\Domain\Registry;

class PositionController
{
    public function getAndCheckRegistry(Application $app, $idRejestru)
    {
        $getRegistry = $app['repositories.registry']->find($idRejestru);

        if($getRegistry === null)
        {
            throw new EmptyRegistryException('Wybrany rejestr jest pusty bądź nie istnieje.');
        }

        return $getRegistry;
    }

    public function addPosition(Application $app, Request $request, $id)
    {
        /** @var Registry $currentRegistry */
        $currentRegistry = $this->getAndCheckRegistry($app, $id);

        $elementFactory  = new CarFactory();
        $positionFactory = new PositionFactory($elementFactory);
        $termFactory     = new TermFactory();

        $positionDTO = new CarDto();
        $positionDTO->brand              = $request->get('brand');
        $positionDTO->model              = $request->get('model');
        $positionDTO->registrationNumber = $request->get('registrationNumber');

        $position = $positionFactory->create($positionDTO);

        $termDTO = new TermDto();
        $termDTO->expiryDate = new \DateTime('2016-08-12 12:17:50');
        $termDTO->notifyBefore = new \DateInterval('P14D');
        $termDTO->whoToNotify = new DepartmentCollection();
        $termDTO->whoToNotify->add(new Department($request->get('department'), 'email'));

        $term = $termFactory->create(AC::TYPE, $termDTO);
        $position->addTerm($term);
        $currentRegistry->addPosition($position);

        $app['repositories.registry']->save($currentRegistry);

        return new Response('OK', 201);
    }
}
