<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 14:02
 */

namespace Madkom\Registries\Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Madkom\Registries\Domain\PositionCollection;
use Madkom\Registries\Domain\PositionCriteria;
use Madkom\Registries\Domain\Registry as Registry;
use Madkom\Registries\Domain\RegistryRepository;

class RegistryRepositoryImpl implements RegistryRepository
{
    const MODEL = 'Madkom\Registries\Domain\Registry';
    /** @var \Doctrine\ORM\EntityManager $em */
    private $em;

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
        //TODO: nie wiem co tu to robi.
    }

    public function delete(Registry $registry)
    {
        $this->em->remove($registry);
        $this->em->flush();
    }

    /**
     * @param $registryId
     *
     * @return Registry
     */
    public function find($registryId)
    {
        return $this->em->getRepository(self::MODEL)
                        ->find($registryId);
    }

    public function findAll()
    {
        return $this->em->getRepository(self::MODEL)
                        ->findAll();
    }
}
