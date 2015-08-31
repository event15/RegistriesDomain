<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 18.08.15
 * Time: 13:52
 */

namespace tests\Madkom\Registries\Domain\Car;

use Madkom\Registries\Domain\Car\CarRegistry;

/**
 * @backupGlobals disabled
 */
class CarRegistryTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CarRegistry $carRegistry */
    protected $carRegistry;

    public function setUp()
    {
        $this->carRegistry = new CarRegistry('samochod');
    }

    public function testGetRegistryType()
    {
        $expected = 'car';

        static::assertEquals(
            $expected,
            $this->carRegistry->getRegistryType(),
            'Dla obiektu ' . get_class($this->carRegistry) . " powinno zwrócić {$expected}"
        );
    }
}
