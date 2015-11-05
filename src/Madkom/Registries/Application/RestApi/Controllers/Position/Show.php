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
use Madkom\Registries\Domain\EmptyRegistryException;
use Silex\Application;

class Show extends ControllerHelper
{
    public function allPositions(Application $app, $registryId)
    {
        $cars = $this->oki($app, $registryId);

        return ($cars) ? $app->json($cars) : $app->json('Nie znaleziono wpisów w rejestrze.', 404);
    }

    public function positionById(Application $app, $registryId, $positionId)
    {
        /** @var EntityManager $em */
        $entity = $app['orm.em'];

        $registry = $entity->find('Madkom\\Registries\\Domain\\Registry', $registryId);
        $this->isExist($positionId, $registry);
        $currentPosition = $registry->getPositions()[$positionId-1];

        return $app->json($currentPosition->showMetadata());
    }

    private function isExist($positionId, $registry)
    {
        if (! $registry->getPositions()[$positionId - 1]) {
            throw new EmptyRegistryException('Wybrana pozycja nie istnieje.');
        }
    }

    private function oki(Application $app, $registryId)
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

        return $cars;
    }
}
