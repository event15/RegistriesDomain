<?php
namespace Infrastructure\Doctrine\Repositories;


use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Models\Registries\RegistryRepositoryInterface;
use Models\Registries\Registry;
use Doctrine\ORM\EntityManager;


class RegistryRepository implements RegistryRepositoryInterface
{
    /** @var \Doctrine\ORM\EntityManager $em */
    private $em;
    const MODEL = "\\Models\\Registries\\Registry";

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param \Models\Registries\Registry $registry
     *
     * @return void
     * @throws \Doctrine\ORM\ORMException
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
     * @param \Models\Registries\Registry $register
     *
     * @return void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function deleteOne(Registry $register)
    {
        try{
            $this->em->remove($register);
            $this->em->flush();
        } catch (ORMInvalidArgumentException $e) {
            throw $e;
        } catch (ORMException $e) {
            throw $e;
        }
    }

    /**
     * @param                             $newName
     * @param \Models\Registries\Registry $register
     *
     * @return void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function changeName($newName, Registry $register)
    {
        try {
            $register->changeName($newName);
            $this->em->persist($register);
            $this->em->flush();
        } catch (ORMInvalidArgumentException $e) {
            throw $e;
        } catch (ORMException $e) {
            throw $e;
        }


    }
}