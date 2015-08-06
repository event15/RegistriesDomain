<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 13:40
 */

namespace Models\Repositories;

use Models\RegistryModel as Registry;

interface RegistryRepositoryInterface
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
     * @param Registry $register
     *
     * @return mixed
     */
    public function deleteOne(Registry $register);
}
