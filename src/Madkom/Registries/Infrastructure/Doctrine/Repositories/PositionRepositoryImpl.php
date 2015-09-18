<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 05.08.15
 * Time: 11:12
 */
namespace Madkom\Registries\Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Madkom\Registries\Domain\PositionRepository;

class PositionRepositoryImpl implements PositionRepository
{
    /** @var \Doctrine\ORM\EntityManager $em */
    private $em;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function prepareToSave($registry)
    {
            $this->em->persist($registry);
    }

    public function save($registry)
    {
            $this->em->flush();
    }

    public function find($model, $id)
    {
        return $this->em->getRepository($model)->find($id);
    }

    public function findAll($model, $id)
    {
        return $this->em->getRepository($model)->findBy(['registryId' => $id]);
    }

    public function deleteOne($element)
    {
        $this->em->remove($element);
        $this->em->flush();
    }
}
