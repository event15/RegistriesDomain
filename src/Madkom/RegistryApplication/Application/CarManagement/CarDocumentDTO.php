<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 08.12.15
 * Time: 12:50
 */

namespace Madkom\RegistryApplication\Application\CarManagement;

class CarDocumentDTO
{
    public $docId;
    public $title;
    public $description;
    public $source;

    /**
     * CarDocumentDTO constructor.
     *
     * @param $docId
     * @param $title
     * @param $description
     * @param $source
     */
    public function __construct($docId, $title, $description, $source)
    {
        $this->docId       = $docId;
        $this->title       = $title;
        $this->description = $description;
        $this->source      = $source;
    }

}