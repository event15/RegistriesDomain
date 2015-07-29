<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 29.07.15
 * Time: 09:32
 */

namespace Models\Users;


class UsersFactory
{
    protected $userRights;

    const ADMIN = 'admin';
    const USER  = 'user';

    public function create($login, $pass, $email, $rights)
    {
        switch($rights)
        {
            case self::ADMIN:
                return new Users($login, $pass, $email, self::ADMIN);
            break;
            case self::USER:
                return new Users($login, $pass, $email, self::USER);
            default:
                return 'Nie znaleziono danego typu użytkownika.';
            break;
        }
    }
}