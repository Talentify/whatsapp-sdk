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
    protected $interactionType;

    abstract public function getInteractive() : array;

    public function toArray() : array
    {
        return $this->getInteractive();
    }
}
