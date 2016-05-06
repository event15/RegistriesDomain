<?php

namespace Madkom\RegistryApplication\Domain\Insurer;

final class Insurer
{
    /** @var string */
    private $id;

    /** @var string */
    private $company;

    /** @var string */
    private $emailToContact;

    /** @var string */
    private $mobileContact;

    /**
     * Insurer constructor.
     *
     * @param $id
     * @param $company
     * @param $emailToContact
     * @param $mobileContact
     */
    public function __construct($id, $company, $emailToContact, $mobileContact)
    {
        $this->id = $id;
        $this->company = $company;
        $this->emailToContact = $emailToContact;
        $this->mobileContact = $mobileContact;
    }

    /**
     * @param $newCompanyName
     */
    public function changeCompany($newCompanyName)
    {
        $this->company = $newCompanyName;
    }

    /**
     * @param $newEmail
     */
    public function changeEmail($newEmail)
    {
        $this->emailToContact = $newEmail;
    }

    /**
     * @param $newMobileNumber
     */
    public function changeMobile($newMobileNumber)
    {
        $this->mobileContact = $newMobileNumber;
    }
}
