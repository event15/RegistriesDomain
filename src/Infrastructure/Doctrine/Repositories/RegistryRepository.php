<?php
namespace Infrastructure\Doctrine\Repositories;


use Models\Registries\Registry;

class RegistryRepository implements \Models\Registries\RegistryRepository
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    const MODEL = "\\Models\\Registries\\Registry";

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param \Models\Registries\Registry $registry
     *
     * @return bool
     */
    public function save(Registry $registry)
    {
        $this->em->persist($registry);
        $this->em->flush();
    }

    /**
     * @param $registryId
     *
     * @return Registry
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
     */
    public function deleteOne(Registry $register)
    {
        $this->em->remove($register);
        $this->em->flush();
    }

    /**
     * @param          $newName
     * @param Registry $register
     */
    public function changeName($newName, Registry $register)
    {
        $register->changeName($newName);
        $this->em->persist($register);
        $this->em->flush();

    }
}