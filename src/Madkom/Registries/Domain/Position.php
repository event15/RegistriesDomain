<?php

namespace Madkom\Registries\Domain;
use Madkom\Registries\Domain\Attachment\Attachment;
use Madkom\Registries\Domain\Attachment\AttachmentCollection;

/**
 * Class Position
 *
 * @package Madkom\Registries\Domain
 */
abstract class Position
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var TermCollection
     */
    protected $terms;

    /** @var  AttachmentCollection */
    protected $attachments;

    abstract public function addTerm(Term $term);

    abstract public function removeTerm(Term $term);

    abstract public function addAttachment(Attachment $attachment);

    abstract public function removeAttachment(Attachment $attachment);

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return TermCollection
     */
    public function getTerms()
    {
        return $this->terms;
    }
}
