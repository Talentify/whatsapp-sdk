<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class Conversation
{
    /** @var string */
    private $id;
    /**
     *    - business_initiated:
     *    indicates that the conversation started by a business sending the first message to a
     *    user. This applies any time it has been more than 24 hours since the last user message.
     *    - user_initiated:
     *    indicates that the conversation started by a business replying to a user message. This applies only when the
     *    business reply is within 24 hours of the last user message.
     *    - referral_conversion:
     *    indicates that the conversation originated from a free entry point.
     *    These conversations are always user-initiated.
     * @var string
     */
    private $type;
    /** @var int|null */
    private $expirationTimestamp;

    public function __construct(string $id, string $type, ?int $expirationTimestamp)
    {
        $this->id                  = $id;
        $this->type                = $type;
        $this->expirationTimestamp = $expirationTimestamp;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getExpirationTimestamp() : ?int
    {
        return $this->expirationTimestamp;
    }
}
