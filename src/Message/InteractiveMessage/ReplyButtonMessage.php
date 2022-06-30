<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message\InteractiveMessage;

class ReplyButtonMessage extends InteractiveMessage
{
    protected $interactionType = 'button';
    /** @var string */
    protected $text;
    /** @var array */
    private array $buttons;

    public function __construct(string $text)
    {
        $this->text    = $text;
        $this->buttons = [];
    }

    public function addButton(array $buttons) : self
    {
        if (count($this->buttons) === 3) {
            throw new \RuntimeException('You can not have more than 3 buttons');
        }

        $replyButton = [];

        foreach ($buttons as $button){
            $replyButton = [
                'type'  => 'reply',
                'reply' => [
                    'title' => $button['title'],
                    'id' => $button['id']
                ],
            ];
        }
        $this->buttons[] = $replyButton;

        return $this;
    }

    public function getInteractive() : array
    {
        return [
            'type' => $this->interactionType,
            'body' => $this->text,
            'action' => [
                'buttons' => $this->buttons
            ]
        ];
    }
}
