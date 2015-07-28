<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 27.07.15
 * Time: 10:30
 */

namespace Models\Registries;

/**
 * Interface RegistryRepository
 * @package Models\Registries
 */
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

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param \Models\Registries\Registry $register
     *
     * @return mixed
     */
    public function deleteOne(Registry $register);

    /**
     * @param                             $newName
     * @param \Models\Registries\Registry $register
     *
     * @return mixed
     */
    public function changeName($newName, Registry $register);
}