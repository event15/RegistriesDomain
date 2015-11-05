<?php

namespace Madkom\Registries\Domain\Attachment;

/**
 * Class Attachment
 * @package Madkom\Registries\Domain\Attachment
 */
class Attachment
{
    /** @var  integer */
    protected $attachmentId;

    /** @var  string */
    protected $name;

    /** @var  string */
    protected $description;

    /** @var  \DateTime */
    protected $uploadDate;

    /** @var  string */
    protected $path;


    protected $carId;

    /**
     * Attachment constructor.
     * @param $url
     * @param $name
     */
    public function __construct($url, $name)
    {
        $this->path  = $url;
        $this->name = $name;
        $this->uploadDate = new \DateTime('now');
    }

    /**
     * @return array
     */
    public function attachmentToArray()
    {
        return [
            'id'          => $this->attachmentId,
            'name'        => $this->name,
            'description' => $this->description,
            'url'         => $this->path
        ];
    }
}
