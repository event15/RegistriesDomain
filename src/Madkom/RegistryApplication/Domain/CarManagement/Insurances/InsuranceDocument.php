<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 19.11.15
 * Time: 09:37
 */

namespace Madkom\RegistryApplication\Domain\CarManagement\Insurances;

use Madkom\RegistryApplication\Domain\CarManagement\Document;

class InsuranceDocument extends Document
{
    public function __construct($id, $title, $description, $source)
    {
        $this->changeTitle($title);
        $this->changeDescription($description);
        parent::__construct($id, $source);
    }
}
