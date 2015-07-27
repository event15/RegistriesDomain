<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 27.07.15
 * Time: 10:30
 */

namespace Models\Registries;


interface RegistryRepository
{
    /**
     * @param Registry $registry
     *
     * @return bool
     */
    public function save(Registry $registry);

    /**
     * @param $registryId
     *
     * @return Registry
     */
    public function find($registryId);

    public function findAll();
}