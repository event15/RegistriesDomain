<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 24.08.15
 * Time: 09:09
 */

namespace Madkom\Registries\Application\RestApi\Controllers\Position;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Madkom\Registries\Application\RestApi\Controllers\ControllerHelper;
use Madkom\Registries\Domain\EmptyRegistryException;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class Show extends ControllerHelper
{
    public function allPositions(Application $app)
    {

        /** @var EntityManager $em */
        $em = $app['orm.em'];

        $cars = $em->createQueryBuilder()
            ->from('Madkom\\Registries\\Domain\\Car\\Car', 'c')
            ->select('c')
            ->getQuery()
            ->getArrayResult();

        return $app->json($cars);
    }

    public function positionById(Application $app, $id, $positionId)
    {
        /** @var EntityManager $em */
        $em = $app['orm.em'];

//        $car = $em->createQueryBuilder()
//                   ->from('Madkom\\Registries\\Domain\\Registry', 'r')
//                   ->select('r')
//                   ->where('c.id = :position')
//                   ->setParameter('position', $positionId)
//                   ->andWhere('c.registryId = :registry')
//                   ->setParameter('registry', $id)
//                   ->getQuery()
//                   ->getSingleResult();
        $registry = $em->find('Madkom\\Registries\\Domain\\Registry' ,$id);


        var_dump($registry->showPositions()[0]->getModel());
        return $app->json(1);
    }
}