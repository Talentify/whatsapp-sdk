<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook;

class Payload
{
    /** @var \Talentify\Whatsapp\Webhook\ValueObject\Metadata */
    private $metadata;
    /** @var \Talentify\Whatsapp\Webhook\ValueObject\Contact[] */
    private $contacts;
    /** @var \Talentify\Whatsapp\Webhook\ValueObject\IncomingMessage[] */
    private $messages;
    /** @var \Talentify\Whatsapp\Webhook\ValueObject\Status[] */
    private $statuses;
    /** @var \Talentify\Whatsapp\Webhook\ValueObject\Error[] */
    private $errors;

    public function __construct(
        ValueObject\Metadata $metadata,
        array $contacts,
        array $messages,
        array $statuses,
        array $errors
    ) {
        $this->metadata = $metadata;
        $this->contacts = $contacts;
        $this->messages = $messages;
        $this->statuses = $statuses;
        $this->errors   = $errors;
    }

    public function getMetadata() : ValueObject\Metadata
    {
        return $this->metadata;
    }

    /**
     * @return \Talentify\Whatsapp\Webhook\ValueObject\Contact[]
     */
    public function getContacts() : array
    {
        return $this->contacts;
    }

    /**
     * @return \Talentify\Whatsapp\Webhook\ValueObject\IncomingMessage[]
     */
    public function getMessages() : array
    {
        return $this->messages;
    }

    /**
     * @return \Talentify\Whatsapp\Webhook\ValueObject\Status[]
     */
    public function getStatuses() : array
    {
        return $this->statuses;
    }

    /**
     * @return \Talentify\Whatsapp\Webhook\ValueObject\Error[]
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
}
