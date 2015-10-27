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
        $entityMgr = $app['orm.em'];

        $registry = $entityMgr->find('Madkom\\Registries\\Domain\\Registry' ,$id);

        return $app->json($registry->showPositions()[$positionId]->getModel());
    }
}
