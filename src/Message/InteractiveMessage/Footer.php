<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message\InteractiveMessage;

class Footer
{
    /** @var string */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function toArray() : array
    {
        return ['text' => $this->text];
    }
}
