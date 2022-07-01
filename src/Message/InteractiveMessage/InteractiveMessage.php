<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message\InteractiveMessage;

use Talentify\Whatsapp\Action;
use Talentify\Whatsapp\Message\Message;

/**
 * https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#interactive-object
 */
abstract class InteractiveMessage extends Message
{
    protected $type = 'interactive';
    /** @var string */
    protected string $interactionType;
    /** @var string */
    protected string $text;

    abstract public function getInteractive() : array;

    public function toArray() : array
    {
        $interactiveMessage = [];

        $interactiveMessage['type'] = $this->interactionType;

        $interactiveMessage['body'] = ['text' => $this->text];

        return array_merge($interactiveMessage, $this->getInteractive());
    }
}
