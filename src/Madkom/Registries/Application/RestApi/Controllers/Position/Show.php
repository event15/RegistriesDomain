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
    public function allPositions(Application $app, $registryId)
    {

        /** @var EntityManager $em */
        $entity = $app['orm.em'];

        $cars = $entity->createQueryBuilder()
            ->from('Madkom\\Registries\\Domain\\Car\\Car', 'c')
            ->select('c')
            ->where('c.registryId = :registry_id')
            ->setParameter('registry_id', $registryId)
            ->getQuery()
            ->getArrayResult();

        if(!$cars) throw new EmptyRegistryException('Nie znaleziono wpisów w rejestrze.');

        return $app->json($cars);
    }

    public function positionById(Application $app, $registryId, $positionId)
    {
        /** @var EntityManager $em */
        $entity = $app['orm.em'];

        $registry = $entity->find('Madkom\\Registries\\Domain\\Registry', $registryId);

        $currentPosition = $registry->getPositions()[$positionId];



        return $app->json($currentPosition->showMetadata());
    }
}
