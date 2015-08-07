<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 05.08.15
 * Time: 11:12
 */
namespace Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Models\ElementModel;
use Models\Repositories\ElementRepositoryInterface;

class ElementRepository implements ElementRepositoryInterface
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

    public function save(ElementModel $registry)
    {
        try {
            $this->em->persist($registry);
            $this->em->flush();
        } catch (ORMInvalidArgumentException $e) {
            throw $e;
        } catch (ORMException $e) {
            throw $e;
        }
    }

    public function find($model, $id, $idElementu)
    {
        return $this->em->getRepository($model)->findBy(array('registryId' => $id, 'carId' => $idElementu));
    }

    public function findAll($model, $id)
    {
        return $this->em->getRepository($model)->findBy(array('registryId' => $id));
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
