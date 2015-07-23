<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 23.07.15
 * Time: 12:40
 */

namespace Models\Users;


class Users
{
    private $userId;
    private $login;
    private $password;
    private $email;
    private $rights;

    /**
     * Users constructor.
     *
     * @param $login
     * @param $password
     * @param $email
     * @param $rights
     */
    public function __construct($login, $password, $email, $rights)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->rights = $rights;
    }


    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $rights
     */
    public function setRights($rights)
    {
        $this->rights = $rights;
    }


}