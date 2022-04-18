<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

/**
 * Metadata about your phone number.
 */
class Metadata
{
    /**
     * Phone number of the business account that is receiving the Webhooks.
     * @var string
     */
    private $displayPhoneNumber;
    /**
     * ID of the phone number receiving the Webhooks. You can use this phone_number_id to send messages back to the
     * customers.
     * @var string
     */
    private $phoneNumberId;

    public function __construct(string $displayPhoneNumber, string $phoneNumberId)
    {
        $this->displayPhoneNumber = $displayPhoneNumber;
        $this->phoneNumberId      = $phoneNumberId;
    }

    public function getDisplayPhoneNumber() : string
    {
        return $this->displayPhoneNumber;
    }

    public function getPhoneNumberId() : string
    {
        return $this->phoneNumberId;
    }
}
