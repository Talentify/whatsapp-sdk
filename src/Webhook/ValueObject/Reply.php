<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class Reply
{
    /** @var string */
    private $id;
    /** @var string */
    private $title;
    /** @var string|null */
    private $description;

    public function __construct(string $id, string $title, ?string $description = null)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }
}
