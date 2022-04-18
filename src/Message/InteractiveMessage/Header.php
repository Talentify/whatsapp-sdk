<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message\InteractiveMessage;

class Header
{
    private $type = 'text'; //There are other types, but we are using this one for now
    /** @var string */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function toArray() : array
    {
        return [
            'type' => $this->type,
            'text' => $this->text,
        ];
    }
}
