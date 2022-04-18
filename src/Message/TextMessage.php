<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message;

/**
 * https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#text-messages
 */
class TextMessage extends Message
{
    protected $type = 'text';
    /** @var string */
    private $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function toArray() : array
    {
        return ['body' => $this->body];
    }
}
