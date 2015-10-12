<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 18.08.15
 * Time: 13:52
 */

namespace Tests\Registries\Domain\Car;

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

    /**
     * @expectedException              \Madkom\Registries\Domain\EmptyRegistryNameException
     * @expectedExceptionMessageRegExp #Registry name must have a value.#
     */
    public function testThrowAnEmptyRegistryNameExceptionWhenCarRegistryNameIsEmpty()
    {
        $badCarRegistry = new CarRegistry('');
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

    public function testShowPositions()
    {
        $object = $this->carRegistry->registryToArray();

        static::assertInternalType('array',$object);
        static::assertEquals(4,count($object));
        static::assertArrayHasKey('id',$object);
        static::assertArrayHasKey('name', $object);
        static::assertArrayHasKey('createdAt', $object);
        static::assertArrayHasKey('positions', $object);
    }
}
