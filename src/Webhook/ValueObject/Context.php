<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class Context
{
    /**
     * WhatsApp ID of the sender of the sent message.
     * @var string
     */
    private $from;
    /**
     * Message ID of the sent message.
     * @var string
     */
    private $id;

    public function __construct(string $from, string $id)
    {
        $this->from = $from;
        $this->id   = $id;
    }

    public function getFrom() : string
    {
        return $this->from;
    }

    public function getId() : string
    {
        return $this->id;
    }
}
