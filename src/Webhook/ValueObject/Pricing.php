<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class Pricing
{
    /**
     * - business_initiated: indicates that the conversation started by a business sending the first message to a user.
     * This applies any time it has been more than 24 hours since the last user message.
     * - user_initiated: indicates that the conversation started by a business replying to a user message. This applies
     * only when the business reply is within 24 hours of the last user message.
     * - referral_conversion: indicates that the conversation originated from a free entry point. These conversations
     * are always user-initiated.
     * @var string
     */
    private $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

    public function getCategory() : string
    {
        return $this->category;
    }
}
