<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 24.08.15
 * Time: 09:09
 */

namespace Madkom\Registries\Application\RestApi\Controllers\Position;

use Doctrine\ORM\EntityManager;
use Madkom\Registries\Application\RestApi\Controllers\ControllerHelper;

use Silex\Application;

class Show extends ControllerHelper
{
    public function allPositions(Application $app, $registryId)
    {
        $cars = $this->oki($app, $registryId);

        return ($cars) ? $app->json($cars) : $app->json([], 204);
    }

    public function positionById(Application $app, $registryId, $positionId)
    {
        $currentPosition = $this->oki($app, $registryId, $positionId);

        return ($currentPosition) ? $app->json($currentPosition) : $app->json([], 204);
    }

    private function oki(Application $app, $registryId, $positionId = null)
    {
        /** @var EntityManager $em */
        $entity = $app['orm.em'];

        $queryBuilder = $entity->createQueryBuilder()
                       ->from('Madkom\\Registries\\Domain\\Car\\Car', 'c')
                       ->select('c')
                       ->where('c.registryId = :registry_id')
                       ->setParameter('registry_id', $registryId);

                        if($positionId) {
                            $queryBuilder->andWhere('c.id = :position_id')
                                         ->setParameter('position_id', $positionId);
                        }

                        $cars = $queryBuilder->getQuery()
                       ->getArrayResult();

        return $cars;
    }
}
