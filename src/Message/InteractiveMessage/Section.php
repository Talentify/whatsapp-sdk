<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message\InteractiveMessage;

class Section
{
    /** @var string */
    private $title;
    /** @var array */
    private $rows;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function addRow(string $id, string $title, string $description) : self
    {
        $this->rows[] = [
            'id'          => $id,
            'title'       => $title,
            'description' => $description,
        ];

        return $this;
    }

    public function toArray() : array
    {
        return [
            'title' => $this->title,
            'rows'  => $this->rows,
        ];
    }
}
