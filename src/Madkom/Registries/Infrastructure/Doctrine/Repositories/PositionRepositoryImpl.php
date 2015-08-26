<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 05.08.15
 * Time: 11:12
 */
namespace Madkom\Registries\Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Madkom\Registries\Domain\Position;
use Madkom\Registries\Domain\PositionRepository;

class PositionRepositoryImpl implements PositionRepository
{
    /** @var \Doctrine\ORM\EntityManager $em */
    private $em;
    const MODEL = "\\Models\\ElementModel";


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

    public function find($model, $id, $idElementu)
    {
        return $this->em->getRepository($model)->findBy([
            'registryId' => $id,
            'carId' => $idElementu
        ]);
    }

    public function findAll($model, $id)
    {
        return $this->em->getRepository($model)->findBy([
            'registryId' => $id
        ]);
    }

    public function deleteOne($element)
    {
        try {
            $this->em->remove($element);
            $this->em->flush();
        } catch (ORMInvalidArgumentException $e) {
            throw $e;
        } catch (ORMException $e) {
            throw $e;
        }
    }
}
