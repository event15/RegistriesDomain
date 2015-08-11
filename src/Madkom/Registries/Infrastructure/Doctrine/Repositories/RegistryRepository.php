<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 14:02
 */

namespace Madkom\Registries\Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Madkom\Registries\Domain\Car\CarRegistry;
use Madkom\Registries\Domain\PositionCollection;
use Madkom\Registries\Domain\PositionCriteria;
use Madkom\Registries\Domain\Registry as Registry;
use Madkom\Registries\Domain\RegistryRepository as RegistryRepositoryInterface;

class RegistryRepository implements RegistryRepositoryInterface
{
    /** @var \Doctrine\ORM\EntityManager $em */
    private $em;
    const MODEL = 'Madkom\Registries\Domain\Registry';

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function save(Registry $registry)
    {
        $this->em->persist($registry);
        $this->em->flush();
    }

    /**
     * @param PositionCriteria $positionCriteria
     *
     * @return PositionCollection
     */
    public function findPositions(PositionCriteria $positionCriteria)
    {
        // TODO: Implement findPositions() method.
    }

    /**
     * @param $registryId
     *
     * @return Registry
     */
    public function find($registryId)
    {
        // TODO: Implement find() method.
    }

    public function findAll()
    {
        return $this->em->getRepository(self::MODEL)->findAll();
    }
}
