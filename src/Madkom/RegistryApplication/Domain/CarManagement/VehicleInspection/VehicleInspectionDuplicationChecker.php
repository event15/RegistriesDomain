<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 19.11.15
 * Time: 13:06.
 */
namespace Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection;

/**
 * Class VehicleInspectionDuplicationChecker.
 */
class VehicleInspectionDuplicationChecker
{
    /**
     * @param array                                                                                $existingVehicleInspection
     * @param \Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspection $newVehicleInspection
     *
     * @return bool
     */
    public function checkForDuplicates(array $existingVehicleInspection, VehicleInspection $newVehicleInspection)
    {
        /** @var VehicleInspection $vehicleInspection */
        foreach ($existingVehicleInspection as $vehicleInspection) {
            if ($newVehicleInspection->getLastInspection() === $vehicleInspection->getLastInspection() ||
               $newVehicleInspection->getId() === $vehicleInspection->getId()
            ) {
                return true;
            }
        }

        return false;
    }
}
