<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class Error
{
    /** @var string */
    private $code;
    /** @var string */
    private $title;

    public function __construct(string $code, string $title)
    {
        $this->code  = $code;
        $this->title = $title;
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getTitle() : string
    {
        return $this->title;
    }
}
