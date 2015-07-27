<?php
namespace Infrastructure\Doctrine\Repositories;


use Models\Registries\Registry;

class RegistryRepository implements \Models\Registries\RegistryRepository
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param \Models\Registries\Registry $registry
     *
     * @return bool
     */
    public function save(\Models\Registries\Registry $registry)
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
        return $this->em->getRepository("\\Models\\Registries\\Registry")->find($registryId);
    }

    public function findAll()
    {
        return $this->em->getRepository("\\Models\\Registries\\Registry")->findAll();
    }


}