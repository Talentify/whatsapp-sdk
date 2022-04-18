<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message\InteractiveMessage;

class ReplyButtonMessage extends InteractiveMessage
{
    protected $interactionType = 'button';
    /** @var string */
    protected $text;
    /** @var array */
    private $buttons;

    public function __construct(string $text)
    {
        $this->text    = $text;
        $this->buttons = [];
    }

    public function addButton(string $title, string $id) : self
    {
        if (count($this->buttons) === 3) {
            throw new \RuntimeException('You can not have more than 3 buttons');
        }
        $this->buttons[] = [
            'type'  => 'reply',
            'reply' => ['title' => $title, 'id' => $id],
        ];

        return $this;
    }

    public function getAction() : array
    {
        return [
            'buttons' => $this->buttons,
        ];
    }
}
