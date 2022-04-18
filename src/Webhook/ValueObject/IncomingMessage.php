<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class IncomingMessage
{
    /**
     * The customer's phone number.
     * @var string
     */
    private $from;
    /**
     * Unique identifier of incoming message, you could use messages endpoint to mark it as read.
     * @var string
     */
    private $id;
    /**
     * Timestamp when customer sends a message.
     * @var int
     */
    private $timestamp;

    /**
     * The type of message being received.
     *
     *  text: for text messages.
     *  image: for image (media) messages.
     *  document: for document (media) messages.
     *  unknown: for unknown messages.
     *  system: for user number change messages.
     *  button: for responses to interactive message templates.
     *  audio: for audio messages.
     *  video: for video messages.
     *  interactive: for list and reply button messages.
     *  sticker: for sticker messages.
     * @var string
     */
    private $type;

    /**
     * Added to Webhook if type=text.
     * @var \Talentify\Whatsapp\Webhook\ValueObject\Text|null
     */
    private $text;

    /**
     * Added to Webhook when you receive an interactive message
     * @var \Talentify\Whatsapp\Webhook\ValueObject\Interactive|null
     */
    private $interactive;

    /**
     * Added to Webhook if a message is forwarded or an inbound reply.
     * @var \Talentify\Whatsapp\Webhook\ValueObject\Context|null
     */
    private $context;

    private function __construct(string $from, string $id, int $timestamp, string $type)
    {
        $this->from      = $from;
        $this->id        = $id;
        $this->timestamp = $timestamp;
        $this->type      = $type;
    }

    public static function fromData(array $data) : self
    {
        $message = new self(
            $data['from'],
            $data['id'],
            (int)$data['timestamp'],
            $data['type']
        );

        switch ($message->getType()) {
            case 'text':
                $message->text = new Text($data['text']['body']);
                break;
            case 'interactive':
                $message->interactive = Interactive::fromInteractive($data['interactive']);
                break;
            default:
                throw new \RuntimeException($message->getType() . ' message support not implemented');
        }

        if (isset($data['context'])) {
            $message->context = new Context(
                $data['context']['from'],
                $data['context']['id']
            );
        }

        return $message;
    }

    public function getFrom() : string
    {
        return $this->from;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getTimestamp() : int
    {
        return $this->timestamp;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getText() : ?Text
    {
        return $this->text;
    }

    public function getInteractive() : ?Interactive
    {
        return $this->interactive;
    }
}
