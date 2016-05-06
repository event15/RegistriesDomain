<?php

namespace Madkom\RegistryApplication\Domain\CarManagement;

abstract class Document
{
    private $id;

    private $source;

    private $createDate;

    private $title;

    private $description;

    public function __construct($id, $source)
    {
        $this->id = $id;
        $this->source = $source;
        $this->createDate = new \DateTime('now');
    }

    public function changeTitle($newTitle)
    {
        $this->title = $newTitle;
    }

    public function changeDescription($newDescription)
    {
        $this->description = $newDescription;
    }

    public function getId()
    {
        return $this->id;
    }
}
