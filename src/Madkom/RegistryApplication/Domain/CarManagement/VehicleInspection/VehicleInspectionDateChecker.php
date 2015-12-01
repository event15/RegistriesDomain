<?php

namespace Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection;

/**
 * Class VehicleInspectionDateChecker
 *
 * @package Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection
 */
class VehicleInspectionDateChecker
{
    /**
     * @param \Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspection $newVehicleInspection
     *
     * @return bool
     */
    public function checkDates(VehicleInspection $newVehicleInspection)
    {
        $interval = $newVehicleInspection->getUpcomingInspection()->diff($newVehicleInspection->getLastInspection());
        $interval = $interval->format('%R%a');

        return ((int) $interval >= 0) ? true : false;
    }
}
