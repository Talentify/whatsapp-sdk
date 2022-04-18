<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class Contact
{
    /**
     * WhatsApp ID of the customer. You can send messages using this wa_id.
     * @var string
     */
    private $wa_id;
    /** @var \Talentify\Whatsapp\Webhook\ValueObject\Profile */
    private $profile;

    public function __construct(?string $wa_id, Profile $profile)
    {
        $this->wa_id   = $wa_id;
        $this->profile = $profile;
    }

    public function getWaId() : ?string
    {
        return $this->wa_id;
    }

    public function getProfile() : Profile
    {
        return $this->profile;
    }
}
