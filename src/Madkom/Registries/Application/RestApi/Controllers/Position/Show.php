<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 24.08.15
 * Time: 09:09
 */

namespace Madkom\Registries\Application\RestApi\Controllers\Position;
https://helion.pl/users/get.cgi?ident=SZABKO_EBOOK&control=004c01b36cc4d0388267d35d21882be57b7ed13dc1f3dca244c618b6ff7175c0&format=mobi
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
        $cars = $this->oki($app, $registryId);

        if(!$cars) throw new EmptyRegistryException('Nie znaleziono wpisów w rejestrze.');

        return $app->json($cars);
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
