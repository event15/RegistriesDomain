<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 19.11.15
 * Time: 09:36
 */

namespace Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection;

use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException;

class VehicleInspection
{
    /** @var  string */
    private $id;

    /** @var  \DateTime */
    private $lastInspection;

    /** @var  \DateTime */
    private $upcomingInspection;

    /**
     * VehicleInspection constructor.
     *
     * @param $id
     * @param $lastInspection
     * @param $upcomingInspection
     */
    private function __construct($id, $lastInspection, $upcomingInspection)
    {
        $this->id                 = $id;
        $this->lastInspection     = $lastInspection;
        $this->upcomingInspection = $upcomingInspection;
    }

    /**
     * @param $id
     * @param $lastInspection
     * @param $upcomingInspection
     *
     * @return \Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspection
     * @throws \Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException
     */
    public static function createVehicleInspection($id, $lastInspection = 'now', $upcomingInspection)
    {
        return new self(
            $id,
            new \DateTime($lastInspection),
            new \DateTime($upcomingInspection)
        );
    }

    /** @return \DateTime $this->lastInspection */
    public function getLastInspection()
    {
        return $this->lastInspection;
    }

    /** @return \DateTime $this->upcomingInspection */
    public function getUpcomingInspection()
    {
        return $this->upcomingInspection;
    }

    /** @return string $this->id */
    public function getId()
    {
        return $this->id;
    }
}
