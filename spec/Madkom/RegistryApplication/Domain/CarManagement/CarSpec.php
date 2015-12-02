<?php

namespace spec\Madkom\RegistryApplication\Domain\CarManagement;

use Madkom\RegistryApplication\Domain\CarManagement\DocumentFactory;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\InsuranceFactory;
use Madkom\RegistryApplication\Domain\CarManagement\VehicleInspection\VehicleInspection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CarSpec
 *
 * @package spec\Madkom\RegistryApplication\Domain\CarManagement
 * @mixin \Madkom\RegistryApplication\Domain\CarManagement\Car
 */
class CarSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedThrough(
            'createCustom', [
                '123-123',
                'fiat',
                '123p',
                'gd 12345',
                new \DateTime('now'), // Production date
                new \DateTime('now'), // Warranty period
                'Gdynia',
                'DRO'
            ]
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\RegistryApplication\Domain\CarManagement\Car');
    }

    public function it_possible_to_add_new_VehicleInspection()
    {
        $newVehicleInspection = $this->prepareVehicleInspection('1', '2011-01-12', '2015-11-20');
        $this->addVehicleInspection($newVehicleInspection);

        $this->getVehicleInspection()->shouldBeArray();
        $this->getVehicleInspection()->shouldContain($newVehicleInspection);
    }

    public function it_is_not_possible_to_add_the_same_VehicleInspections()
    {
        $newVehicleInspection           = $this->prepareVehicleInspection('1', '2015-11-20', '2016-11-20');
        $theSameVehicleInspection       = $this->prepareVehicleInspection('1', '2015-11-20', '2016-11-20');
        $reversedDatesVehicleInspection = $this->prepareVehicleInspection('2', '2050-11-20', '2000-11-20');


        $this->addVehicleInspection($newVehicleInspection);

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\DuplicatedVehicleInspectionException')
             ->during('addVehicleInspection', [$theSameVehicleInspection]);

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\InvalidDatesException')
             ->during('addVehicleInspection', [$reversedDatesVehicleInspection]);
    }

    public function it_is_possible_to_add_multiple_different_VehicleInspections_to_car()
    {
        $newVehicleInspection      = $this->prepareVehicleInspection('1', '2015-11-20', '2016-11-20');
        $otherNewVehicleInspection = $this->prepareVehicleInspection('2', '2016-11-10', '2016-11-20');

        $this->addVehicleInspection($newVehicleInspection);
        $this->addVehicleInspection($otherNewVehicleInspection);
    }

    public function it_is_should_be_possible_to_remove_a_selected_VehicleInspection_from_car()
    {
        $newVehicleInspection = $this->prepareVehicleInspection('1', '2015-11-20', '2016-11-20');
        $this->addVehicleInspection($newVehicleInspection);

        $this->removeVehicleInspection($newVehicleInspection);
        $this->getVehicleInspection()->shouldBeArray();
        $this->getVehicleInspection()->shouldNotContain($newVehicleInspection);
    }

    public function it_is_not_possible_to_remove_a_nonexistent_VehicleInspection_from_car()
    {
        $newVehicleInspection     = $this->prepareVehicleInspection('1', '2015-11-20', '2016-11-20');
        $omittedVehicleInspection = $this->prepareVehicleInspection('2', '2015-11-20', '2016-11-20');

        // Adding only $newVehicleInspection
        $this->addVehicleInspection($newVehicleInspection);

        // Trying to remove $omittedVehicleInspection
        $this->shouldThrow('\Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\RemovingNonexistentElementException')
             ->during('removeVehicleInspection', [$omittedVehicleInspection]);
    }

    public function it_is_possible_to_add_new_Insurances_to_car()
    {
        $insurances     = [];
        $insuranceTypes = ['AC', 'OC', 'ASS', 'NWW'];
        $insuranceId    = '123-123-123';
        $dateFrom       = new \DateTime('23-11-2015');
        $dateTo         = new \DateTime('23-11-2016');

        $insuranceFactory = new InsuranceFactory();

        foreach ($insuranceTypes as $type) {
            $insurances[$type] = $insuranceFactory->create($type, $dateFrom, $dateTo, $insuranceId);
            $this->addInsurance($insurances[$type]);
            $this->getInsurance()->shouldContain($insurances[$type]);
        }
    }

    public function it_should_be_impossible_to_add_the_same_Insurances()
    {
        $insurerId = '123-123-123';
        $dateFrom  = new \DateTime('23-11-2015');
        $dateTo    = new \DateTime('23-11-2016');

        $invalidDateFrom = new \DateTime('23-11-2015');
        $invalidDateTo   = new \DateTime('23-11-2016');

        $insuranceFactory    = new InsuranceFactory();
        $carInsurance        = $insuranceFactory->create('AC', $dateFrom, $dateTo, $insurerId);
        $theSameCarInsurance = $insuranceFactory->create('AC', $dateFrom, $dateTo, $insurerId);
        $badCarInsurance     = $insuranceFactory->create('AC', $invalidDateFrom, $invalidDateTo, $insurerId);

        $this->addInsurance($carInsurance);
        $this->shouldThrow('InvalidArgumentException')->during('addInsurance', [$theSameCarInsurance]);
        $this->shouldThrow('InvalidArgumentException')->during('addInsurance', [$badCarInsurance]);
    }

    public function it_should_be_possible_to_remove_Insurance()
    {
        $insuranceId = '123-123-123';
        $dateFrom  = new \DateTime('23-11-2015');
        $dateTo    = new \DateTime('23-11-2016');

        $insuranceFactory    = new InsuranceFactory();
        $carInsurance        = $insuranceFactory->create('AC', $dateFrom, $dateTo, $insuranceId);
        $this->addInsurance($carInsurance);
        $this->getInsurance()->shouldContain($carInsurance);

        $this->removeInsurance($carInsurance);
        $this->getInsurance()->shouldNotContain($carInsurance);
    }

    public function it_should_be_impossible_to_remove_nonexistent_Insurance()
    {
        $insuranceId = '123-123-123';
        $dateFrom  = new \DateTime('23-11-2015');
        $dateTo    = new \DateTime('23-11-2016');

        $insuranceFactory    = new InsuranceFactory();
        $carInsurance        = $insuranceFactory->create('AC', $dateFrom, $dateTo, $insuranceId);
        $this->addInsurance($carInsurance);
        $this->getInsurance()->shouldContain($carInsurance);

        $this->removeInsurance($carInsurance);
        $this->getInsurance()->shouldNotContain($carInsurance);

        $this->shouldThrow('\InvalidArgumentException')->during('removeInsurance', [$carInsurance]);
    }

    public function it_should_be_possible_to_add_InsuranceDocument_to_Insurance()
    {
        $insuranceId = '123-123-123';
        $dateFrom  = new \DateTime('23-11-2015');
        $dateTo    = new \DateTime('23-11-2016');

        $insuranceFactory    = new InsuranceFactory();
        $carInsurance        = $insuranceFactory->create('AC', $dateFrom, $dateTo, $insuranceId);
        $this->addInsurance($carInsurance);
        $this->getInsurance()->shouldContain($carInsurance);

        $carInsuranceDocument = new DocumentFactory();
        $document = $carInsuranceDocument
             ->create(DocumentFactory::INSURANCE_DOCUMENT, 'AC-123', 'AC wrzesień 2015', 'Uzupełnić o nowe dane.', 'path/to/ac_document/1.pdf');

        $this->addInsuranceDocument($carInsurance->getId(), $document);
        $this->getInsuranceDocuments($carInsurance->getId())
             ->shouldContain($document);

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\NonexistentInsuranceException')
             ->during('addInsuranceDocument', ['NonexistentID', $document]);
        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\NonexistentInsuranceException')
             ->during('getInsuranceDocuments', ['NonexistentID', $document]);
    }

    public function it_should_be_possible_to_remove_InsuranceDocument_from_Insurance()
    {
        $insuranceId = '123-123-123';
        $dateFrom  = new \DateTime('23-11-2015');
        $dateTo    = new \DateTime('23-11-2016');

        $insuranceFactory    = new InsuranceFactory();
        $carInsurance        = $insuranceFactory->create('AC', $dateFrom, $dateTo, $insuranceId);
        $this->addInsurance($carInsurance);
        $this->getInsurance()->shouldContain($carInsurance);

        $carInsuranceDocument = new DocumentFactory();
        $document = $carInsuranceDocument
            ->create(DocumentFactory::INSURANCE_DOCUMENT, 'AC-123', 'AC wrzesień 2015', 'Uzupełnić o nowe dane.', 'path/to/ac_document/1.pdf');

        $this->addInsuranceDocument($carInsurance->getId(), $document);
        $this->getInsuranceDocuments($carInsurance->getId())
             ->shouldContain($document);

        $this->removeInsuranceDocument($carInsurance->getId(), $document->getId());
    }

    public function it_should_be_possible_to_add_new_CarDocument_to_Car()
    {
        $insuranceId = '123-123-123';
        $dateFrom  = new \DateTime('23-11-2015');
        $dateTo    = new \DateTime('23-11-2016');

        $insuranceFactory    = new InsuranceFactory();
        $carInsurance        = $insuranceFactory->create('AC', $dateFrom, $dateTo, $insuranceId);
        $this->addInsurance($carInsurance);
        $this->getInsurance()->shouldContain($carInsurance);

        $carInsuranceDocument = new DocumentFactory();
        $document = $carInsuranceDocument
            ->create(DocumentFactory::CAR_DOCUMENT, 'AC-123', 'AC wrzesień 2015', 'Uzupełnić o nowe dane.', 'path/to/ac_document/1.pdf');

        $this->addCarDocument($document);
        $this->getCarDocument()
             ->shouldContain($document);
    }

    public function it_should_be_possible_to_change_metadata_for_car()
    {
        $this->changeCity('Gdynia');
        $this->changeDepartment('DRO');
    }

    private function prepareVehicleInspection($id, $lastInspection, $upcomingInspection)
    {
        return VehicleInspection::createVehicleInspection(
            $id,
            new \DateTime($lastInspection),
            new \DateTime($upcomingInspection)
        );
    }
}
