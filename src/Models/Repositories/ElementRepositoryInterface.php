<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 13:41
 */
namespace Models\Repositories;

use Models\ElementModel;

interface ElementRepositoryInterface
{
    public function save(ElementModel $registry);
    public function find($model, $id, $idElementu);
    public function findAll($model, $id);
    public function deleteOne(ElementModel $car);
}
