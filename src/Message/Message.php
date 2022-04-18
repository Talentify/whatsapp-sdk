<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message;

abstract class Message
{
    /** @var string */
    protected $type;
    /** @var string */
    protected $fromNumberId;
    /** @var string */
    protected $to;

    public function setFromNumberId(string $fromNumberId) : self
    {
        $this->fromNumberId = $fromNumberId;

        return $this;
    }

    public function setTo(string $to) : self
    {
        $this->to = $to;

        return $this;
    }

    public function getFromNumberId() : string
    {
        return $this->fromNumberId;
    }

    public function type() : string
    {
        return $this->type;
    }

    public function to() : string
    {
        return $this->to;
    }

    abstract public function toArray() : array;
}
