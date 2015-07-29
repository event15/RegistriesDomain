<?php
/**
 * Created by PhpStorm.
 * User: PFIG
 * Date: 2015-07-28
 * Time: 21:50
 */

namespace Models\Registries;


interface ObjectRepositoryInterface
{
    public function save(Registry $registry);
    public function find();
    public function findAll();
    public function deleteOne();

    public function changeBrand();
    public function changeModel();
    public function changeRegistrationNumber();
    public function changeInsurer();
    public function changeOthers();
    public function changeAttachments();
}