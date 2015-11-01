<?php

namespace Madkom\Registries\Domain\Attachment;

use Doctrine\Common\Collections\ArrayCollection;

class AttachmentCollection extends ArrayCollection
{
    public function add($attachment)
    {
        return parent::add($attachment);
    }

    public function removeElement($attachment)
    {
        parent::removeElement($attachment);
    }

    public function get($attachment)
    {
        parent::get($attachment);
    }
}