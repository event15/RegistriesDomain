<?php
/**
 * Created by PhpStorm.
 * User: PFIG
 * Date: 2015-07-28
 * Time: 21:49
 */

namespace Infrastructure\Doctrine\Repositories;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Models\Registries\CarRegistry\Car;
use Models\Registries\CarRegistry\CarRegistry;
use Models\Registries\ElementRepositoryInterface;
use Models\Registries\Registry;

/**
 * Class ElementRepository
 *
 * @package Infrastructure\Doctrine\Repositories
 */
class ElementRepository implements ElementRepositoryInterface
{
    /** @var \Doctrine\ORM\EntityManager $em */
    private $em;
    const MODEL = "\\Models\\Registries\\CarRegistry\\Car";


    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    /**
     * @param Car $registry
     *
     * @throws ORMException
     * @throws \Exception
     */
    public function save(Car $registry)
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

    public function find()
    {
        // TODO: Implement find() method.
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    public function deleteOne()
    {
        // TODO: Implement deleteOne() method.
    }

    public function changeBrand()
    {
        // TODO: Implement changeBrand() method.
    }

    public function changeModel()
    {
        // TODO: Implement changeModel() method.
    }

    public function changeRegistrationNumber()
    {
        // TODO: Implement changeRegistrationNumber() method.
    }

    public function changeInsurer()
    {
        // TODO: Implement changeInsurer() method.
    }

    public function changeOthers()
    {
        // TODO: Implement changeOthers() method.
    }

    public function changeAttachments()
    {
        // TODO: Implement changeAttachments() method.
    }
}