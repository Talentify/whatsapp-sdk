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
    /** @var Header|null */
    protected $header;
    /** @var string */
    protected $text;
    /** @var Footer|null */
    protected $footer;

    public function setHeader(Header $header) : self
    {
        $this->header = $header;

        return $this;
    }

    public function setFooter(Footer $footer) : self
    {
        $this->footer = $footer;

        return $this;
    }

    abstract public function getAction() : array;

    public function toArray() : array
    {
        $message         = [];
        $message['type'] = $this->interactionType;
        if ($this->header !== null) {
            $message['header'] = $this->header->toArray();
        }
        $message['body'] = ['text' => $this->text];
        if ($this->footer !== null) {
            $message['footer'] = $this->footer->toArray();
        }
        $message['action'] = $this->getAction();

        return $message;
    }
}
