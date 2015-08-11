<?php

namespace Madkom\Registries\Domain;
use Madkom\Registries\Domain\Car\CarRegistry;

/**
 * Interface RegistryRepository
 * @package Madkom\Registries\Domain
 */
interface RegistryRepository
{

    /**
     * @param Registry $registry
     * @return mixed
     */
    public function save(Registry $registry);

    /**
     * @param $registryId
     * @return Registry
     */
    public function find($registryId);

    public function findAll();

    /**
     * @param PositionCriteria $positionCriteria
     * @return PositionCollection
     */
    public function findPositions(PositionCriteria $positionCriteria);

}
