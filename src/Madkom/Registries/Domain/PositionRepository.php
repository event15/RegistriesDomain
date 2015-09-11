<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 04.08.15
 * Time: 13:41
 */
namespace Madkom\Registries\Domain;


interface PositionRepository
{
    public function save($registry);
    public function find($model, $id);
    public function findAll($model, $id);
    public function deleteOne($element);
}
