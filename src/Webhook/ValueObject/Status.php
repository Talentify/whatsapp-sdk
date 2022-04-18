<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class Status
{

    /**
     * Message ID
     * @var string
     */
    private $id;
    /**
     * WhatsApp ID of recipient
     * @var string
     */
    private $recipientId;
    /**
     * Timestamp of the status message.
     * @var int
     */
    private $timestamp;
    /**
     * Status of a message.
     *
     * deleted
     * delivered
     * failed
     * read
     * sent
     * warning
     * @var string
     */
    private $status;
    /** @var \Talentify\Whatsapp\Webhook\ValueObject\Conversation|null */
    private $conversation;
    /** @var \Talentify\Whatsapp\Webhook\ValueObject\Pricing|null */
    private $pricing;

    private function __construct(string $id, string $recipient_id, int $timestamp, string $status)
    {
        $this->id          = $id;
        $this->recipientId = $recipient_id;
        $this->timestamp   = $timestamp;
        $this->status      = $status;
    }

    public static function fromData(array $data) : self
    {
        $status = new self(
            $data['id'],
            $data['recipient_id'],
            (int)$data['timestamp'],
            $data['status']
        );
        if (isset($data['conversation'])) {
            $conversationData     = $data['conversation'];
            $status->conversation = new Conversation(
                $conversationData['id'],
                $conversationData['origin']['type'],
                $conversationData['expiration_timestamp'] ? (int)$conversationData['expiration_timestamp'] : null
            );
        }
        if (isset($data['pricing'])) {
            $status->pricing = new Pricing($data['pricing']['category']);
        }

        return $status;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getRecipientId() : string
    {
        return $this->recipientId;
    }

    public function getTimestamp() : int
    {
        return $this->timestamp;
    }

    public function getStatus() : string
    {
        return $this->status;
    }

    public function getConversation() : ?Conversation
    {
        return $this->conversation;
    }

    public function getPricing() : ?Pricing
    {
        return $this->pricing;
    }
}
