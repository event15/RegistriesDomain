<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 29.07.15
 * Time: 13:08
 */

namespace Models\Users;


interface UserRepositoryInterface
{
    public function save(Users $user);

}