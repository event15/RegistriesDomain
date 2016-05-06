<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 19.11.15
 * Time: 09:47.
 */
namespace Madkom\RegistryApplication\Domain\CarManagement;

use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\EmptyDocumentTypeException;
use Madkom\RegistryApplication\Domain\CarManagement\CarExceptions\UnknownDocumentTypeException;
use Madkom\RegistryApplication\Domain\CarManagement\Insurances\InsuranceDocument;

class DocumentFactory
{
    const CAR_DOCUMENT = 1;
    const INSURANCE_DOCUMENT = 2;

    public function create($type, $id, $title, $description, $source)
    {
        switch ($type) {
            case self::CAR_DOCUMENT:
                return new CarDocument($id, $title, $description, $source);
            break;
            case self::INSURANCE_DOCUMENT:
                return new InsuranceDocument($id, $title, $description, $source);
            break;
            case null:
                throw new EmptyDocumentTypeException('Document type must not be empty.');
            break;
            default:
                throw new UnknownDocumentTypeException('Unknown document type: '.$type);
        }
    }
}
