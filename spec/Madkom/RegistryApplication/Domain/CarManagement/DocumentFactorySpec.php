<?php

namespace spec\Madkom\RegistryApplication\Domain\CarManagement;

use Madkom\RegistryApplication\Domain\CarManagement\DocumentFactory;
use PhpSpec\ObjectBehavior;

/**
 * Class DocumentFactorySpec.
 *
 * @mixin \Madkom\RegistryApplication\Domain\CarManagement\DocumentFactory
 */
class DocumentFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Madkom\RegistryApplication\Domain\CarManagement\DocumentFactory');
    }

    public function it_is_possible_to_create_CarDocument()
    {
        $id = 'CD-123-123';
        $title = 'Poprawny tytuł';
        $description = 'Poprawny opis';
        $source = 'Poprawna ścieżka';

        $this->create(DocumentFactory::CAR_DOCUMENT, $id, $title, $description, $source)
            ->shouldBeAnInstanceOf('Madkom\RegistryApplication\Domain\CarManagement\CarDocument');

        $this->create(DocumentFactory::INSURANCE_DOCUMENT, $id, $title, $description, $source)
             ->shouldBeAnInstanceOf('Madkom\RegistryApplication\Domain\CarManagement\Insurances\InsuranceDocument');
    }

    public function it_should_be_impossible_to_create_document_with_invalid_type()
    {
        $id = 'CD-123-123';
        $title = 'Poprawny tytuł';
        $description = 'Poprawny opis';
        $source = 'Poprawna ścieżka';

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\UnknownDocumentTypeException')
            ->during('create', ['invalid_type', $id, $title, $description, $source]);

        $this->shouldThrow('Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\EmptyDocumentTypeException')
             ->during('create', ['', $id, $title, $description, $source]);
    }
}
