<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class Text
{
    /**
     * The text of the message.
     * @var string
     */
    private $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function getBody() : string
    {
        return $this->body;
    }
}
