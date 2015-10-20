<?php

namespace Madkom\Registries\Domain\Department;

/**
 * Class Department
 *
 * @package Madkom\Registries\Domain\Department
 */
class Department
{
    /** @var  integer */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    protected $terms;

    /**
     * Department constructor.
     *
     * @param string $name
     * @param string $email
     */
    public function __construct($name, $email)
    {
        $this->name  = $name;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getTerms()
    {
        return $this->terms;
    }
}
