<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message\InteractiveMessage;

class ListMessage extends InteractiveMessage
{
    protected $interactionType = 'list';
    /** @var string */
    protected $text;
    /** @var string */
    private $button;
    /** @var \Talentify\Whatsapp\Message\InteractiveMessage\Section[] */
    private $sections;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function addButton(string $text) : self
    {
        $this->button = $text;

        return $this;
    }

    public function addSection(Section $section) : self
    {
        $this->sections[] = $section;

        return $this;
    }

    public function getAction() : array
    {
        $message             = [];
        $message['button']   = $this->button;
        $message['sections'] = [];
        foreach ($this->sections as $section) {
            $message['sections'][] = $section->toArray();
        }

        return $message;
    }
}
