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
use Madkom\Registries\Domain\Car\Term\OC;
use Madkom\Registries\Domain\Department\Department;
use Madkom\Registries\Domain\Department\DepartmentCollection;
use Madkom\Registries\Domain\PositionFactory;
use Madkom\Registries\Domain\TermDto;
use Madkom\Registries\Domain\TermFactory;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PositionController
{

    public function addPosition(Application $app, Request $request, $id)
    {

        $helper = new ControllerHelper();
        $currentRegistry = $helper->findAndCheckRegistry($app, $id);

        $elementFactory  = new CarFactory();
        $positionFactory = new PositionFactory($elementFactory);
        $termFactory     = new TermFactory();

        $positionDTO = new CarDto();
        $positionDTO->brand              = $request->get('brand');
        $positionDTO->model              = $request->get('model');
        $positionDTO->registrationNumber = $request->get('registrationNumber');
        $positionDTO->others             = $request->get('others');

        $position = $positionFactory->create($positionDTO);

        $termDTO = new TermDto();
        $termDTO->expiryDate = new \DateTime('2016-08-12 12:17:50');

        $termDTO->notifyBefore = new \DateTime('2016-08-12 12:17:50');

        $notifyTemp = new \DateInterval('P1Y');
        $notifyTemp->invert = 1;
        $termDTO->notifyBefore->add($notifyTemp);


        $termDTO->whoToNotify = new DepartmentCollection();
        $termDTO->whoToNotify->add(new Department($request->get('department'), 'email'));

        $term = $termFactory->create(AC::TYPE, $termDTO);
        $term1 = $termFactory->create(OC::TYPE, $termDTO);
        $position->addTerm($term);
        $position->addTerm($term1);



        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $app['orm.em'];

        $em->persist($term);
        $em->persist($term1);
        $em->persist($currentRegistry);
        $em->flush();
        $app['repositories.position']->save($position);
//        $app['repositories.registry']->save($currentRegistry);

        return new Response('OK', 201);
    }
}
