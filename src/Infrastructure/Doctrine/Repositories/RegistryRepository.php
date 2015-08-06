<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 14:02
 */

namespace Infrastructure\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Models\RegistryModel as Registry;
use Models\Repositories\RegistryRepositoryInterface;

class RegistryRepository implements RegistryRepositoryInterface
{
    /** @var \Doctrine\ORM\EntityManager $em */
    private $em;
    const MODEL = "\\Models\\RegistryModel";

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param Registry $registry
     *
     * @return void
     * @throws ORMException
     * @throws \Exception
     */
    public function save(Registry $registry)
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

    /**
     * @param $registryId
     *
     * @return null|object
     */
    public function find($registryId)
    {
        return $this->em->getRepository(self::MODEL)->find($registryId);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->em->getRepository(self::MODEL)->findAll();
    }

    /**
     * @param Registry $register
     *
     * @return void
     * @throws ORMException
     * @throws \Exception
     */
    public function deleteOne(Registry $register)
    {
        try {
            $this->em->remove($register);
            $this->em->flush();
        } catch (ORMInvalidArgumentException $e) {
            throw $e;
        } catch (ORMException $e) {
            throw $e;
        }
    }

    /**
     * This function aren't modify data in DB. You must '$app[]->save();' after use this method.
     *
     * @param Registry $register
     * @param          $registerId
     * @param          $newName
     */
    public function modifyOne(Registry $register, $registerId, $newName)
    {
        $this->find($registerId);
        $register->changeName($newName);
    }
}
